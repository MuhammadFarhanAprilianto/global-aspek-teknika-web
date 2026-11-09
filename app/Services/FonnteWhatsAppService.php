<?php

namespace App\Services;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FonnteWhatsAppService
{
    /**
     * Kirim Dokumen PDF Sales Quote Asli + Teks Pesanan dalam 1 Bubble Chat ke WA Admin
     * (dan salinannya ke WA Pembeli) menggunakan Fonnte WhatsApp Gateway API.
     *
     * @return array{sent: bool, configured: bool, message: string}
     */
    public function sendOrderConfirmationPdf(Order $order): array
    {
        $token = trim((string) config('services.whatsapp.fonnte_token', ''));
        $endpoint = (string) config('services.whatsapp.fonnte_endpoint', 'https://api.fonnte.com/send');
        $adminPhone = $this->normalizePhone((string) config('services.whatsapp.admin_number', '6285732021121'));

        if ($token === '') {
            return [
                'sent' => false,
                'configured' => false,
                'message' => 'Pesanan berhasil tercatat di sistem. Untuk mengaktifkan pengiriman otomatis File PDF Sales Quote ke WhatsApp (' . $adminPhone . '), silakan masukkan FONNTE_TOKEN Anda di file .env.',
            ];
        }

        $order->loadMissing(['items.product:id,sku,name,specifications']);

        $shortHash = strtoupper(substr($order->verification_hash, 0, 16));
        $verifyUrl = route('checkout.verify', [
            'uuid' => $order->uuid,
            'hash' => strtolower($shortHash),
        ]);
        $qrCodeDataUri = (new \chillerlan\QRCode\QRCode)->render($verifyUrl);

        $pdfBytes = Pdf::loadView('pdf.sales-quote', [
            'order' => $order,
            'logoBase64' => $this->resolveCompanyLogoBase64(),
            'qrCodeDataUri' => $qrCodeDataUri,
            'shortHash' => $shortHash,
        ])->setPaper('a4', 'portrait')->output();

        $pdfFilename = 'Sales_Quote_' . Str::slug($order->company_name ?: 'B2B', '_') . '.pdf';
        $adminCaption = $this->buildAdminCaption($order);

        try {
            // 1. Kirim 1 Bubble Chat (File PDF Sales Quote Asli + Caption Perkenalan, Urgensi & Barang) ke WA Admin
            $adminResponse = Http::timeout(30)
                ->withHeaders([
                    'Authorization' => $token,
                ])
                ->attach('file', $pdfBytes, $pdfFilename, ['Content-Type' => 'application/pdf'])
                ->post($endpoint, [
                    'target' => $adminPhone,
                    'message' => $adminCaption,
                    'filename' => $pdfFilename,
                    'countryCode' => '62',
                ]);

            $adminJson = $adminResponse->json();
            $isSuccess = $adminResponse->successful() && (($adminJson['status'] ?? false) === true);

            if (! $isSuccess) {
                $reason = is_array($adminJson)
                    ? (string) ($adminJson['reason'] ?? $adminJson['detail'] ?? 'Respons gateway tidak berhasil.')
                    : 'HTTP ' . $adminResponse->status();

                $reasonLower = strtolower($reason);

                // Jika perangkat sudah Connected tetapi paket Fonnte masih Free (belum aktif fitur Attachment),
                // kirimkan pesan teks otomatisnya dulu agar koneksi WA tetap teruji sambil memberi panduan upgrade paket.
                if (str_contains($reasonLower, 'package') || str_contains($reasonLower, 'attachment') || str_contains($reasonLower, 'feature')) {
                    $textFallback = Http::timeout(20)
                        ->withHeaders(['Authorization' => $token])
                        ->post($endpoint, [
                            'target' => $adminPhone,
                            'message' => $adminCaption,
                            'countryCode' => '62',
                        ]);

                    $fallbackJson = $textFallback->json();
                    if ($textFallback->successful() && (($fallbackJson['status'] ?? false) === true)) {
                        return [
                            'sent' => false,
                            'configured' => true,
                            'message' => 'Pesan rincian pesanan sudah berhasil masuk ke WhatsApp Admin! Namun lampiran file .pdf belum terkirim karena paket Fonnte Anda masih Free (' . $reason . '). Begitu paket Attachment diaktifkan di menu Buy Package Fonnte, file .pdf akan langsung ikut terkirim otomatis dalam 1 bubble tanpa ubah kode.',
                        ];
                    }
                }

                if (str_contains($reasonLower, 'disconnect')) {
                    $isLocalGateway = str_contains($endpoint, '127.0.0.1') || str_contains($endpoint, 'localhost');

                    return [
                        'sent' => false,
                        'configured' => true,
                        'message' => $isLocalGateway
                            ? 'Pesanan telah tercatat, namun WhatsApp Gateway Lokal belum di-scan QR-nya. Silakan buka http://127.0.0.1:3001 di browser Anda lalu Scan QR Code sekali saja.'
                            : 'Pesanan telah tercatat, namun perangkat WhatsApp masih belum tersambung (Disconnected). Silakan hubungkan kembali QR Code perangkat WhatsApp Anda.',
                    ];
                }

                Log::warning('Fonnte WhatsApp send failed', [
                    'order_uuid' => $order->uuid,
                    'reason' => $reason,
                ]);

                return [
                    'sent' => false,
                    'configured' => true,
                    'message' => 'Pesanan telah tercatat, namun pengiriman PDF ke WhatsApp gagal (' . $reason . '). Pastikan perangkat WhatsApp di dashboard Fonnte berstatus Connected dan paket mendukung Attachment.',
                ];
            }

            // 2. Jika pembeli mengunggah file PO resmi (opsional), kirimkan juga file fisiknya ke WA Admin
            if (! empty($order->po_document_path) && Storage::disk('local')->exists($order->po_document_path)) {
                $poBytes = (string) Storage::disk('local')->get($order->po_document_path);
                if ($poBytes !== '') {
                    $poExt = pathinfo($order->po_document_path, PATHINFO_EXTENSION) ?: 'pdf';
                    $poFilename = 'PO_' . Str::slug($order->company_name ?: 'Korporat', '_') . '.' . $poExt;

                    Http::timeout(30)
                        ->withHeaders(['Authorization' => $token])
                        ->attach('file', $poBytes, $poFilename)
                        ->post($endpoint, [
                            'target' => $adminPhone,
                            'message' => '*Lampiran Dokumen PO Resmi* — ' . $order->company_name . ' (PIC: ' . $order->pic_name . ')',
                            'filename' => $poFilename,
                            'countryCode' => '62',
                        ]);
                }
            }

            // 3. Kirim salinan PDF Sales Quote ke nomor WhatsApp Pembeli (jika diaktifkan & nomor berbeda dari Admin)
            $sendCopyToBuyer = (bool) config('services.whatsapp.send_copy_to_buyer', true);
            $buyerPhone = $this->normalizePhone((string) $order->company_phone);

            if ($sendCopyToBuyer && $buyerPhone !== '' && $buyerPhone !== $adminPhone) {
                Http::timeout(25)
                    ->withHeaders(['Authorization' => $token])
                    ->attach('file', $pdfBytes, $pdfFilename, ['Content-Type' => 'application/pdf'])
                    ->post($endpoint, [
                        'target' => $buyerPhone,
                        'message' => $this->buildBuyerCaption($order),
                        'filename' => $pdfFilename,
                        'countryCode' => '62',
                    ]);
            }

            return [
                'sent' => true,
                'configured' => true,
                'message' => 'Terima kasih, pengajuan pesanan perusahaan Anda telah kami terima. Tim PT Global Aspek Teknologi akan segera menindaklanjuti dan menghubungi Anda untuk proses selanjutnya.',
            ];
        } catch (\Throwable $e) {
            Log::error('Fonnte WhatsApp exception', [
                'order_uuid' => $order->uuid,
                'error' => $e->getMessage(),
            ]);

            return [
                'sent' => false,
                'configured' => true,
                'message' => 'Pesanan berhasil disimpan, namun koneksi ke server WhatsApp Gateway sedang terkendala: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Caption untuk 1 Bubble Dokumen PDF yang masuk ke WhatsApp Admin (Tanpa Link URL Panjang).
     */
    public function buildAdminCaption(Order $order): string
    {
        $urgencyText = trim((string) ($order->notes ?? ''));
        if ($urgencyText === '') {
            $urgencyText = 'Pengadaan kebutuhan operasional perusahaan';
        }

        $lines = [
            'Selamat pagi/siang Admin PT Global Aspek Teknologi,',
            '',
            'Perkenalkan saya *' . $order->pic_name . '*, perwakilan dari *' . $order->company_name . '*.',
            'Berikut data perusahaan kami:',
            '• Nama Perusahaan: ' . $order->company_name,
            '• Nama Pemesan (PIC): ' . $order->pic_name,
            '• No. Telepon/WA: ' . $order->company_phone,
            '• Email: ' . $order->company_email,
            '• NPWP: ' . ($order->npwp ?: '-'),
        ];

        if (! empty($order->company_address)) {
            $lines[] = '• Alamat: ' . preg_replace('/\s+/', ' ', trim($order->company_address));
        }

        $lines[] = '';
        $lines[] = '*Urgensi & Kebutuhan Pesanan:*';
        $lines[] = $urgencyText;
        $lines[] = '';
        $lines[] = '*Rincian Produk yang Dipesan:*';

        foreach ($order->items as $idx => $item) {
            $lines[] = ($idx + 1) . '. ' . $item->product_name
                . ' (SKU: ' . $item->sku . ') — ' . $item->quantity . ' SET';
            foreach ($item->resolvedSpecifications() as $sKey => $sVal) {
                $lines[] = '   - ' . $sKey . ': ' . $sVal;
            }
        }

        $lines[] = '';
        $lines[] = '*Total Estimasi Quote:* Rp ' . number_format((float) $order->grand_total, 2, ',', '.')
            . ' _(termasuk PPN 11% & PPh 23 2%)_';
        $lines[] = '';
        $lines[] = 'Terlampir di atas dokumen *PDF Sales Quote* pengajuan kami. Mohon dibantu tindak lanjut serta penerbitan Nomor Quote resminya. Terima kasih.';

        return implode("\n", $lines);
    }

    /**
     * Caption salinan dokumen PDF Sales Quote untuk WhatsApp Pembeli.
     */
    public function buildBuyerCaption(Order $order): string
    {
        $lines = [
            'Yth. Bapak/Ibu *' . $order->pic_name . '* (*' . $order->company_name . '*),',
            '',
            'Terima kasih telah mengonfirmasi pesanan di *PT Global Aspek Teknologi*.',
            'Terlampir salinan dokumen *PDF Sales Quote* untuk pengajuan Anda:',
        ];

        foreach ($order->items as $idx => $item) {
            $lines[] = ($idx + 1) . '. ' . $item->product_name . ' — ' . $item->quantity . ' SET';
        }

        $lines[] = '';
        $lines[] = '*Total Estimasi:* Rp ' . number_format((float) $order->grand_total, 2, ',', '.')
            . ' _(termasuk PPN 11% & PPh 23 2%)_';
        $lines[] = '';
        $lines[] = 'Tim Admin kami sedang memverifikasi pesanan Anda dan akan segera menghubungi Anda untuk penerbitan Nomor Quote resmi. Terima kasih.';

        return implode("\n", $lines);
    }

    public function normalizePhone(string $rawPhone): string
    {
        $digits = preg_replace('/\D+/', '', $rawPhone) ?: '';
        if (str_starts_with($digits, '0')) {
            return '62' . substr($digits, 1);
        }

        return $digits;
    }

    public function resolveCompanyLogoBase64(): ?string
    {
        $candidates = [
            public_path('storage/Logo_Perusahaan.webp'),
            storage_path('app/public/Logo_Perusahaan.webp'),
        ];

        foreach ($candidates as $path) {
            if (! is_file($path)) {
                continue;
            }

            if (function_exists('imagecreatefromwebp')) {
                $img = @imagecreatefromwebp($path);
                if ($img !== false) {
                    imagepalettetotruecolor($img);
                    imagealphablending($img, true);
                    imagesavealpha($img, true);
                    ob_start();
                    imagepng($img);
                    $pngData = ob_get_clean();
                    imagedestroy($img);

                    if ($pngData) {
                        return 'data:image/png;base64,' . base64_encode($pngData);
                    }
                }
            }

            $raw = @file_get_contents($path);
            if ($raw !== false) {
                return 'data:image/webp;base64,' . base64_encode($raw);
            }
        }

        return null;
    }
}
