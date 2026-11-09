<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Services\FonnteWhatsAppService;
use Barryvdh\DomPDF\Facade\Pdf;
use chillerlan\QRCode\QRCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class CheckoutController extends Controller
{
    /**
     * Inisiasi Checkout B2B dari Pop-Up Form di halaman /product.
     * Seluruh harga satuan, subtotal DPP, dan PPN 11% dihitung 100% di sisi server dari database.
     */
    public function initiate(Request $request): RedirectResponse
    {
        // 1. Keamanan Lapis 1: Honeypot Anti-Bot (Perangkap Bot Tanpa Perlu CAPTCHA)
        if (! empty($request->input('b2b_fax_reference'))) {
            return back()
                ->withErrors(['cart_items_json' => 'Permintaan pengajuan tidak dapat diproses.'])
                ->withInput();
        }

        // 2. Keamanan Lapis 2: Validasi Format Data & Nomor WhatsApp Indonesia Resmi
        $validated = $request->validate([
            'cart_items_json' => ['required', 'string', 'max:10000'],
            'pic_name' => ['required', 'string', 'max:120'],
            'company_name' => ['required', 'string', 'max:160'],
            'company_email' => ['required', 'email', 'max:160'],
            'company_phone' => [
                'required',
                'string',
                'max:30',
                'regex:/^(\+62|62|0)8[1-9][0-9]{7,11}$/',
            ],
            'company_address' => ['nullable', 'string', 'max:500'],
            'npwp' => ['nullable', 'string', 'max:40'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ], [
            'pic_name.required' => 'Nama lengkap PIC wajib diisi.',
            'company_name.required' => 'Nama resmi perusahaan (PT/CV/Instansi) wajib diisi.',
            'company_email.required' => 'Email korporat wajib diisi.',
            'company_email.email' => 'Format email korporat tidak valid.',
            'company_phone.required' => 'Nomor telepon / WhatsApp aktif wajib diisi.',
            'company_phone.regex' => 'Format nomor WhatsApp tidak valid. Gunakan format seluler Indonesia aktif (contoh: 0812xxxxxxxx atau 62812xxxxxxxx).',
        ]);

        $decodedItems = json_decode($validated['cart_items_json'], true);
        if (! is_array($decodedItems) || empty($decodedItems) || count($decodedItems) > 50) {
            return back()
                ->withErrors(['cart_items_json' => 'Pilih minimal 1 produk di keranjang sebelum melanjutkan ke pembayaran.'])
                ->withInput();
        }

        // Sanitasi baris keranjang beserta spesifikasi yang dipilih per item
        $rawLines = [];
        $productIds = [];

        foreach ($decodedItems as $rawItem) {
            if (! is_array($rawItem)) {
                continue;
            }
            $productId = isset($rawItem['id']) ? (int) $rawItem['id'] : 0;
            $qty = isset($rawItem['qty']) ? (int) $rawItem['qty'] : 0;
            $submittedSpecs = (isset($rawItem['specs']) && is_array($rawItem['specs'])) ? $rawItem['specs'] : [];

            if ($productId > 0 && $qty > 0) {
                $productIds[$productId] = true;
                $rawLines[] = [
                    'product_id' => $productId,
                    'qty' => min(9999, $qty),
                    'specs' => $submittedSpecs,
                ];
            }
        }

        if (empty($rawLines)) {
            return back()
                ->withErrors(['cart_items_json' => 'Daftar produk di keranjang tidak valid.'])
                ->withInput();
        }

        $order = DB::transaction(function () use ($rawLines, $productIds, $validated, $request) {
            $products = Product::query()
                ->whereIn('id', array_keys($productIds))
                ->where('status', 'published')
                ->get(['id', 'sku', 'name', 'price', 'min_order_quantity', 'specifications'])
                ->keyBy('id');

            if ($products->isEmpty()) {
                throw ValidationException::withMessages([
                    'cart_items_json' => 'Produk yang dipilih saat ini tidak tersedia.',
                ]);
            }

            // Gabungkan kuantitas jika produk & kombinasi spesifikasi identik; pisahkan baris jika spesifikasi berbeda
            $groupedLines = [];
            foreach ($rawLines as $line) {
                $product = $products->get($line['product_id']);
                if (! $product) {
                    continue;
                }

                $sanitizedSpecs = $this->resolveAndSanitizeSpecs($product, $line['specs']);
                $groupKey = $product->id . '::' . json_encode($sanitizedSpecs, JSON_UNESCAPED_UNICODE);

                if (! isset($groupedLines[$groupKey])) {
                    $groupedLines[$groupKey] = [
                        'product' => $product,
                        'specs' => $sanitizedSpecs,
                        'qty' => 0,
                    ];
                }

                $groupedLines[$groupKey]['qty'] = min(9999, $groupedLines[$groupKey]['qty'] + $line['qty']);
            }

            if (empty($groupedLines)) {
                throw ValidationException::withMessages([
                    'cart_items_json' => 'Produk yang dipilih saat ini tidak tersedia.',
                ]);
            }

            $subtotal = 0.0;
            $preparedItems = [];

            foreach ($groupedLines as $entry) {
                /** @var Product $product */
                $product = $entry['product'];
                $moq = max(1, (int) ($product->min_order_quantity ?? 1));
                $qty = max($moq, $entry['qty']);
                $unitPrice = round((float) $product->price, 2);
                $lineTotal = round($unitPrice * $qty, 2);

                $subtotal = round($subtotal + $lineTotal, 2);

                $preparedItems[] = [
                    'product_id' => $product->id,
                    'sku' => $product->sku,
                    'product_name' => $product->name,
                    'selected_specifications' => $entry['specs'],
                    'unit_price' => $unitPrice,
                    'quantity' => $qty,
                    'line_total' => $lineTotal,
                ];
            }

            $taxRate = 11.00;
            $taxAmount = round($subtotal * ($taxRate / 100), 2);
            $pph23Rate = 2.00;
            $pph23Amount = round($subtotal * ($pph23Rate / 100), 2);
            $grandTotal = round($subtotal + $taxAmount - $pph23Amount, 2);

            $uuid = (string) Str::uuid();
            $invoiceNumber = $this->generateUniqueInvoiceNumber();
            $verificationHash = hash_hmac(
                'sha256',
                $uuid . '|' . $invoiceNumber . '|' . number_format($grandTotal, 2, '.', ''),
                (string) config('app.key')
            );

            $order = Order::create([
                'uuid' => $uuid,
                'invoice_number' => $invoiceNumber,
                'verification_hash' => $verificationHash,
                'pic_name' => trim($validated['pic_name']),
                'company_name' => trim($validated['company_name']),
                'company_email' => strtolower(trim($validated['company_email'])),
                'company_phone' => trim($validated['company_phone']),
                'company_address' => ! empty($validated['company_address']) ? trim($validated['company_address']) : null,
                'npwp' => ! empty($validated['npwp']) ? trim($validated['npwp']) : null,
                'notes' => ! empty($validated['notes']) ? trim($validated['notes']) : null,
                'subtotal' => $subtotal,
                'tax_rate' => $taxRate,
                'tax_amount' => $taxAmount,
                'pph23_rate' => $pph23Rate,
                'pph23_amount' => $pph23Amount,
                'grand_total' => $grandTotal,
                'payment_method' => 'po_proforma',
                'status' => 'awaiting_po',
                'ip_address' => $request->ip(),
                'user_agent' => Str::limit((string) $request->userAgent(), 500, ''),
                'expires_at' => now()->addDays(14),
            ]);

            foreach ($preparedItems as $itemData) {
                $order->items()->create($itemData);
            }

            return $order;
        });

        return redirect()->to(
            URL::temporarySignedRoute('checkout.show', $order->expires_at, ['order' => $order->uuid])
        );
    }

    /**
     * Halaman Pembayaran / Sales Quote Resmi B2B & Konfirmasi Pesanan.
     * Dilindungi oleh Cryptographic Signed URL agar tidak dapat ditebak publik.
     */
    public function show(Request $request, Order $order): View
    {
        $order->load(['items.product:id,sku,name,image,slug,specifications']);

        $expiresAt = $order->expires_at ?? now()->addDays(14);
        $shortHash = strtoupper(substr($order->verification_hash, 0, 16));

        $submitPoUrl = URL::temporarySignedRoute('checkout.submit-po', $expiresAt, [
            'order' => $order->uuid,
        ]);

        $quotePdfUrl = $this->buildQuotePdfSignedUrl($order);

        $verifyUrl = route('checkout.verify', [
            'uuid' => $order->uuid,
            'hash' => strtolower($shortHash),
        ]);

        return view('checkout', [
            'order' => $order,
            'shortHash' => $shortHash,
            'submitPoUrl' => $submitPoUrl,
            'quotePdfUrl' => $quotePdfUrl,
            'verifyUrl' => $verifyUrl,
        ]);
    }

    /**
     * Konfirmasi Pesanan ke Admin, Simpan PO (Opsional), & Kirim Otomatis File PDF Sales Quote Asli
     * + Caption Pesanan dalam 1 Bubble Chat ke WhatsApp Admin & Pembeli melalui Fonnte API.
     */
    public function submitPo(Request $request, Order $order, FonnteWhatsAppService $whatsappService): RedirectResponse
    {
        if ($order->expires_at && $order->expires_at->isPast()) {
            return back()->withErrors([
                'po_document' => 'Masa berlaku Quote ini telah berakhir. Silakan buat pengajuan baru dari halaman Produk.',
            ]);
        }

        // 3. Keamanan Lapis 5: Anti-Replay / Cooldown Proteksi Spam Klik WhatsApp
        $isAlreadySubmitted = ($order->status === 'po_submitted');
        $hasNewFile = $request->hasFile('po_document');

        if ($isAlreadySubmitted && ! $hasNewFile) {
            $lastSubmittedAt = $order->po_submitted_at ?? $order->updated_at;
            if ($lastSubmittedAt && $lastSubmittedAt->diffInMinutes(now()) < 5) {
                $expiresAt = $order->expires_at ?? now()->addDays(14);
                $redirectBackUrl = URL::temporarySignedRoute('checkout.show', $expiresAt, [
                    'order' => $order->uuid,
                ]);

                return redirect()->to($redirectBackUrl)->with(
                    'po_success',
                    'Pesanan perusahaan Anda telah berhasil dikonfirmasi ke WhatsApp Admin sebelumnya. Tim PT Global Aspek Teknologi sedang menindaklanjuti pengajuan ini.'
                );
            }
        }

        $request->validate([
            'po_document' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ], [
            'po_document.mimes' => 'Lampiran dokumen PO harus berformat PDF, JPG, JPEG, atau PNG.',
            'po_document.max' => 'Ukuran maksimal lampiran dokumen PO adalah 5 MB.',
        ]);

        $privatePath = $order->po_document_path;

        if ($request->hasFile('po_document')) {
            $file = $request->file('po_document');

            // 4. Keamanan Lapis 4: Validasi Magic Bytes (Anti-Malware & Script Backdoor Upload)
            $realPath = $file->getRealPath();
            $stream = $realPath ? @fopen($realPath, 'rb') : null;
            $headerBytes = $stream ? fread($stream, 8) : '';
            if ($stream) {
                fclose($stream);
            }

            $isValidMagic = str_starts_with($headerBytes, '%PDF-')
                || str_starts_with($headerBytes, "\xFF\xD8\xFF")
                || str_starts_with($headerBytes, "\x89PNG\r\n\x1a\n");

            if (! $isValidMagic) {
                return back()->withErrors([
                    'po_document' => 'Berkas lampiran tidak valid atau terindikasi rusak. Mohon unggah dokumen PDF atau gambar resmi asli.',
                ]);
            }

            $extension = strtolower($file->getClientOriginalExtension() ?: $file->extension() ?: 'pdf');
            $filename = 'PO-' . $order->uuid . '-' . now()->format('YmdHis') . '.' . $extension;
            $newPath = $file->storeAs('po_documents/' . now()->format('Y-m'), $filename, 'local');

            if ($order->po_document_path && Storage::disk('local')->exists($order->po_document_path)) {
                Storage::disk('local')->delete($order->po_document_path);
            }

            $privatePath = $newPath;
        }

        $order->update([
            'po_document_path' => $privatePath,
            'status' => 'po_submitted',
            'po_submitted_at' => $order->po_submitted_at ?? now(),
        ]);

        session()->flash('clear_rfq_cart', true);

        $waResult = $whatsappService->sendOrderConfirmationPdf($order);
        $expiresAt = $order->expires_at ?? now()->addDays(14);
        $redirectBackUrl = URL::temporarySignedRoute('checkout.show', $expiresAt, [
            'order' => $order->uuid,
        ]);

        if ($waResult['sent']) {
            return redirect()->to($redirectBackUrl)->with('po_success', $waResult['message']);
        }

        return redirect()->to($redirectBackUrl)->with('whatsapp_warning', $waResult['message']);
    }

    /**
     * Generate & Stream Dokumen PDF Sales Quote Resmi PT Global Aspek Teknologi (Signed URL).
     * Dilengkapi QR Code Verifikasi Keaslian Dokumen Digital Anti-Pemalsuan Fisik.
     */
    public function downloadQuotePdf(Request $request, Order $order, string $filename, FonnteWhatsAppService $whatsappService): Response
    {
        $order->load(['items.product:id,sku,name,specifications']);

        $shortHash = strtoupper(substr($order->verification_hash, 0, 16));
        $verifyUrl = route('checkout.verify', [
            'uuid' => $order->uuid,
            'hash' => strtolower($shortHash),
        ]);
        $qrCodeDataUri = (new QRCode)->render($verifyUrl);

        $pdf = Pdf::loadView('pdf.sales-quote', [
            'order' => $order,
            'logoBase64' => $whatsappService->resolveCompanyLogoBase64(),
            'qrCodeDataUri' => $qrCodeDataUri,
            'shortHash' => $shortHash,
        ])->setPaper('a4', 'portrait');

        $safeFilename = 'Sales_Quote_' . Str::slug($order->company_name ?: 'B2B', '_') . '.pdf';

        return $pdf->stream($safeFilename);
    }

    /**
     * Unduh / Buka Lampiran Dokumen PO Perusahaan melalui Signed URL Terenkripsi.
     */
    public function downloadPoDocument(Request $request, Order $order, string $filename): Response
    {
        if (! $order->po_document_path || ! Storage::disk('local')->exists($order->po_document_path)) {
            abort(404, 'Lampiran dokumen PO tidak ditemukan.');
        }

        return Storage::disk('local')->response($order->po_document_path, basename($order->po_document_path));
    }

    /**
     * Halaman Verifikasi Keaslian Proforma Invoice (Anti-Fraud / Anti-BEC).
     */
    public function verify(string $uuid, string $hash): View
    {
        $order = Order::where('uuid', $uuid)->first();
        $expectedShortHash = $order ? strtolower(substr($order->verification_hash, 0, 16)) : '';
        $isValid = $order !== null
            && strlen($hash) === 16
            && hash_equals($expectedShortHash, strtolower($hash));

        return view('verify-invoice', [
            'isValid' => $isValid,
            'order' => $isValid ? $order : null,
            'providedHash' => strtoupper($hash),
        ]);
    }

    /**
     * Bangun Signed URL untuk file PDF Sales Quote resmi.
     */
    private function buildQuotePdfSignedUrl(Order $order): string
    {
        $expiresAt = $order->expires_at ?? now()->addDays(14);
        $slugCompany = Str::slug($order->company_name ?: 'Korporat', '-');
        $pdfFilename = 'Sales-Quote-' . ($slugCompany ?: 'B2B') . '.pdf';

        return URL::temporarySignedRoute('checkout.quote-pdf', $expiresAt, [
            'order' => $order->uuid,
            'filename' => $pdfFilename,
        ]);
    }

    /**
     * Generate nomor Sales Quote resmi sesuai standar PT Global Aspek Teknologi (Contoh: QU/1001/26).
     */
    private function generateUniqueInvoiceNumber(): string
    {
        $yearShort = now()->format('y');
        $baseSequence = 1000 + Order::whereYear('created_at', now()->year)->count() + 1;

        for ($attempt = 0; $attempt < 15; $attempt++) {
            $candidate = 'QU/' . ($baseSequence + $attempt) . '/' . $yearShort;
            if (! Order::where('invoice_number', $candidate)->exists()) {
                return $candidate;
            }
        }

        return 'QU/' . random_int(2000, 9999) . '/' . $yearShort;
    }

    /**
     * Validasi spesifikasi yang dipilih pembeli terhadap opsi resmi produk di database.
     *
     * @param  array<string, mixed>  $submittedSpecs
     * @return array<string, string>
     */
    private function resolveAndSanitizeSpecs(Product $product, array $submittedSpecs): array
    {
        $catalogSpecs = $product->specifications;
        if (empty($catalogSpecs) || ! is_array($catalogSpecs)) {
            return [];
        }

        $resolved = [];
        foreach ($catalogSpecs as $specKey => $specVal) {
            $label = (string) $specKey;

            // Ekstrak daftar opsi jika berupa array atau string yang dipisah " / "
            $options = [];
            if (is_array($specVal)) {
                $options = array_values(array_filter(array_map(fn ($v) => trim((string) $v), $specVal), fn ($v) => $v !== ''));
            } elseif (is_string($specVal) && str_contains($specVal, ' / ')) {
                $options = array_values(array_filter(array_map('trim', explode(' / ', $specVal)), fn ($v) => $v !== ''));
            }

            if (count($options) > 1) {
                $picked = isset($submittedSpecs[$label]) && is_scalar($submittedSpecs[$label])
                    ? trim((string) $submittedSpecs[$label])
                    : '';

                $resolved[$label] = in_array($picked, $options, true) ? $picked : $options[0];
            } else {
                $fixedValue = is_array($specVal) ? (string) ($options[0] ?? '') : trim((string) $specVal);
                if ($fixedValue !== '') {
                    $resolved[$label] = $fixedValue;
                }
            }
        }

        return $resolved;
    }
}

