<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\FonnteWhatsAppService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class IntegrationAdminController extends Controller
{
    public function index(): View
    {
        $settings = SiteSetting::allMerged();
        $activeSocialLinks = SiteSetting::activeSocialLinks();
        $activeChannelsCount = SiteSetting::activeChannelsCount();

        return view('admin.integrations.index', compact(
            'settings',
            'activeSocialLinks',
            'activeChannelsCount'
        ));
    }

    /**
     * Cek apakah aplikasi berjalan di lingkungan serverless (Vercel) tanpa daemon Node.js lokal
     */
    private function isServerlessRuntime(): bool
    {
        $isVercel = ! empty($_SERVER['VERCEL']) || ! empty($_ENV['VERCEL']) || getenv('VERCEL') === '1';
        $hasGatewayScript = is_file(base_path('whatsapp-gateway' . DIRECTORY_SEPARATOR . 'server.js'));

        return $isVercel || ! $hasGatewayScript;
    }

    /**
     * Simpan Nomor WhatsApp Admin & Publik serta opsi Cloud Gateway (Fonnte / Custom API)
     */
    public function updateWhatsApp(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'wa_admin_number' => ['required', 'string', 'max:40'],
            'wa_public_number' => ['required', 'string', 'max:40'],
            'wa_gateway_mode' => ['nullable', 'in:local,cloud'],
            'wa_gateway_endpoint' => ['nullable', 'url', 'max:500'],
            'wa_gateway_token' => ['nullable', 'string', 'max:255'],
        ], [
            'wa_admin_number.required' => 'Nomor WhatsApp Admin Order Quotation wajib diisi.',
            'wa_public_number.required' => 'Nomor WhatsApp Admin Marketing wajib diisi.',
            'wa_gateway_endpoint.url' => 'URL Endpoint Cloud Gateway harus diawali https:// atau http://.',
        ]);

        $adminPhone = SiteSetting::normalizePhone($validated['wa_admin_number']);
        $publicPhone = SiteSetting::normalizePhone($validated['wa_public_number']);
        $mode = $validated['wa_gateway_mode'] ?? (string) SiteSetting::getValue('wa_gateway_mode', 'local');
        $endpoint = trim((string) ($validated['wa_gateway_endpoint'] ?? ''));
        $token = trim((string) ($validated['wa_gateway_token'] ?? ''));

        $pairs = [
            'wa_gateway_enabled' => '1',
            'wa_admin_number' => $adminPhone,
            'wa_public_number' => $publicPhone,
            'wa_send_copy_to_buyer' => '0',
            'wa_gateway_mode' => $mode,
        ];

        if ($mode === 'cloud' && $endpoint !== '') {
            $pairs['wa_gateway_endpoint'] = $endpoint;
            if ($token !== '') {
                $pairs['wa_gateway_token'] = $token;
            }
        } elseif ($mode === 'local') {
            $pairs['wa_gateway_endpoint'] = (string) config('services.whatsapp.fonnte_endpoint', 'http://127.0.0.1:3001/send');
        }

        SiteSetting::setMany('whatsapp', $pairs);

        return back()->with('admin_toast', [
            'type' => 'success',
            'title' => 'Pengaturan WhatsApp Diperbarui',
            'message' => "WhatsApp Admin Order Quotation ({$adminPhone}) & Marketing ({$publicPhone}) langsung aktif di seluruh website.",
        ]);
    }

    /**
     * Simpan pengaturan tautan Social Media, Email Publik & status Hide/Unhide masing-masing kanal
     */
    public function updateSocial(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'social_linkedin' => ['nullable', 'url', 'max:500'],
            'social_instagram' => ['nullable', 'url', 'max:500'],
            'social_youtube' => ['nullable', 'url', 'max:500'],
            'social_facebook' => ['nullable', 'url', 'max:500'],
            'social_tiktok' => ['nullable', 'url', 'max:500'],
            'social_email' => ['required', 'email', 'max:255'],
            'social_linkedin_visible' => ['nullable', 'in:0,1'],
            'social_instagram_visible' => ['nullable', 'in:0,1'],
            'social_youtube_visible' => ['nullable', 'in:0,1'],
            'social_facebook_visible' => ['nullable', 'in:0,1'],
            'social_tiktok_visible' => ['nullable', 'in:0,1'],
            'social_email_visible' => ['nullable', 'in:0,1'],
        ], [
            'social_linkedin.url' => 'URL LinkedIn harus diawali https://',
            'social_instagram.url' => 'URL Instagram harus diawali https://',
            'social_youtube.url' => 'URL YouTube harus diawali https://',
            'social_facebook.url' => 'URL Facebook harus diawali https://',
            'social_tiktok.url' => 'URL TikTok harus diawali https://',
            'social_email.required' => 'Email kontak publik wajib diisi.',
            'social_email.email' => 'Format email kontak publik tidak valid.',
        ]);

        SiteSetting::setMany('social', [
            'social_linkedin' => trim((string) ($validated['social_linkedin'] ?? '')),
            'social_instagram' => trim((string) ($validated['social_instagram'] ?? '')),
            'social_youtube' => trim((string) ($validated['social_youtube'] ?? '')),
            'social_facebook' => trim((string) ($validated['social_facebook'] ?? '')),
            'social_tiktok' => trim((string) ($validated['social_tiktok'] ?? '')),
            'social_email' => trim($validated['social_email']),
            'social_linkedin_visible' => ($validated['social_linkedin_visible'] ?? '1') === '1' ? '1' : '0',
            'social_instagram_visible' => ($validated['social_instagram_visible'] ?? '0') === '1' ? '1' : '0',
            'social_youtube_visible' => ($validated['social_youtube_visible'] ?? '0') === '1' ? '1' : '0',
            'social_facebook_visible' => ($validated['social_facebook_visible'] ?? '0') === '1' ? '1' : '0',
            'social_tiktok_visible' => ($validated['social_tiktok_visible'] ?? '0') === '1' ? '1' : '0',
            'social_email_visible' => ($validated['social_email_visible'] ?? '1') === '1' ? '1' : '0',
        ]);

        return back()->with('admin_toast', [
            'type' => 'success',
            'title' => 'Social Media Diperbarui',
            'message' => 'Tautan & visibilitas media sosial langsung tersinkron ke tombol Popout (+) dan Footer website.',
        ]);
    }

    /**
     * Toggle Hide / Unhide per kanal Social Media & Email secara instan (1 klik)
     */
    public function toggleSocialVisibility(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'channel' => ['required', 'in:linkedin,instagram,youtube,facebook,tiktok,email'],
            'visible' => ['required', 'boolean'],
        ]);

        $channel = $validated['channel'];
        $visible = (bool) $validated['visible'];

        SiteSetting::setMany('social', [
            "social_{$channel}_visible" => $visible ? '1' : '0',
        ]);

        $labels = [
            'linkedin' => 'LinkedIn',
            'instagram' => 'Instagram',
            'youtube' => 'YouTube',
            'facebook' => 'Facebook',
            'tiktok' => 'TikTok',
            'email' => 'Email (Gmail)',
        ];
        $label = $labels[$channel] ?? ucfirst($channel);
        $currentVal = trim((string) SiteSetting::getValue("social_{$channel}", ''));
        $hasValue = $currentVal !== '';

        if ($visible && ! $hasValue) {
            $msg = "{$label} diaktifkan — isi tautannya lalu klik Simpan agar langsung tampil di tombol Popout (+).";
        } elseif ($visible) {
            $msg = "{$label} sekarang ditampilkan di tombol Popout (+) & Footer website.";
        } else {
            $msg = "{$label} disembunyikan sementara dari tombol Popout (+) & Footer website.";
        }

        return response()->json([
            'ok' => true,
            'channel' => $channel,
            'visible' => $visible,
            'has_value' => $hasValue,
            'active_channels_count' => SiteSetting::activeChannelsCount(),
            'message' => $msg,
        ]);
    }

    /**
     * Proxy status koneksi & QR Code dari WhatsApp Gateway Lokal atau Cloud API
     */
    public function gatewayStatus(): JsonResponse
    {
        $settings = SiteSetting::allMerged();
        $endpoint = trim((string) ($settings['wa_gateway_endpoint'] ?? 'http://127.0.0.1:3001/send'));
        $mode = (string) ($settings['wa_gateway_mode'] ?? 'local');
        $isLocalHost = str_contains($endpoint, '127.0.0.1') || str_contains($endpoint, 'localhost');

        if ($mode === 'cloud' && ! $isLocalHost && $endpoint !== '') {
            return response()->json([
                'reachable' => true,
                'local_supported' => false,
                'mode' => 'cloud',
                'device_status' => 'external',
                'state' => 'external',
                'device' => null,
                'qr' => null,
                'message' => 'Menggunakan Cloud WhatsApp Gateway eksternal.',
            ]);
        }

        if ($this->isServerlessRuntime()) {
            return response()->json([
                'reachable' => false,
                'local_supported' => false,
                'mode' => 'wa_me',
                'device_status' => 'serverless',
                'state' => 'serverless',
                'device' => null,
                'qr' => null,
                'message' => 'Serverless cloud aktif: pesanan B2B & Uji WA otomatis diarahkan via Tautan WhatsApp Langsung (wa.me).',
            ]);
        }

        $baseUrl = preg_replace('#/send/?$#i', '', $endpoint);
        $statusUrl = rtrim((string) $baseUrl, '/') . '/status';

        try {
            $res = Http::timeout(4)->get($statusUrl);
            if ($res->successful()) {
                $json = $res->json();
                return response()->json([
                    'reachable' => true,
                    'local_supported' => true,
                    'mode' => 'local',
                    'device_status' => $json['device_status'] ?? 'disconnect',
                    'state' => $json['state'] ?? 'disconnected',
                    'device' => $json['device'] ?? null,
                    'qr' => $json['qr'] ?? null,
                    'package' => $json['package'] ?? 'Self-Hosted Baileys',
                ]);
            }
        } catch (\Throwable $e) {
            // Gateway server belum dijalankan
        }

        return response()->json([
            'reachable' => false,
            'local_supported' => true,
            'mode' => 'local',
            'device_status' => 'offline',
            'state' => 'offline',
            'device' => null,
            'qr' => null,
            'message' => 'Server WhatsApp Gateway lokal belum aktif.',
        ]);
    }

    /**
     * Nyalakan Server WhatsApp Gateway Lokal (port 3001) langsung dari Admin Dashboard (1 klik)
     */
    public function gatewayStart(): JsonResponse
    {
        if ($this->isServerlessRuntime()) {
            return response()->json([
                'ok' => false,
                'serverless' => true,
                'message' => 'Mesin Gateway Node.js lokal tidak berjalan di cloud Vercel. Di Vercel gunakan mode Tautan Langsung (wa.me), Cloud API (Fonnte), atau pindahkan ke VPS.',
            ], 422);
        }

        // Cek apakah port 3001 sudah menyala
        $sock = @fsockopen('127.0.0.1', 3001, $errno, $errstr, 0.5);
        if ($sock !== false) {
            fclose($sock);
            return response()->json(['ok' => true, 'already_running' => true, 'message' => 'WhatsApp Gateway sudah berjalan di port 3001.']);
        }

        $serverScript = base_path('whatsapp-gateway' . DIRECTORY_SEPARATOR . 'server.js');
        if (!is_file($serverScript)) {
            return response()->json(['ok' => false, 'message' => 'File whatsapp-gateway/server.js tidak ditemukan.'], 404);
        }

        try {
            if (PHP_OS_FAMILY === 'Windows') {
                $cmd = 'start /B "" node "' . $serverScript . '" > NUL 2>&1';
                @pclose(@popen($cmd, 'r'));
            } else {
                $cmd = 'nohup node ' . escapeshellarg($serverScript) . ' >/dev/null 2>&1 &';
                @exec($cmd);
            }

            // Tunggu singkat hingga port 3001 mulai menerima koneksi (maks ~2.5 detik)
            $started = false;
            for ($i = 0; $i < 10; $i++) {
                usleep(250000);
                $check = @fsockopen('127.0.0.1', 3001, $e1, $e2, 0.3);
                if ($check !== false) {
                    fclose($check);
                    $started = true;
                    break;
                }
            }

            return response()->json([
                'ok' => true,
                'started' => $started,
                'message' => $started
                    ? 'WhatsApp Gateway berhasil dinyalakan. Memuat status & QR Code...'
                    : 'Perintah menyalakan Gateway dikirim. Menunggu koneksi port 3001...',
            ]);
        } catch (\Throwable $e) {
            return response()->json(['ok' => false, 'message' => 'Gagal menyalakan gateway: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Putuskan perangkat WA lokal & muat ulang QR baru
     */
    public function gatewayLogout(): JsonResponse
    {
        $settings = SiteSetting::allMerged();
        $endpoint = trim((string) ($settings['wa_gateway_endpoint'] ?? 'http://127.0.0.1:3001/send'));
        $baseUrl = preg_replace('#/send/?$#i', '', $endpoint);
        $logoutUrl = rtrim((string) $baseUrl, '/') . '/logout';

        try {
            $res = Http::timeout(6)->post($logoutUrl);
            return response()->json(['ok' => $res->successful()]);
        } catch (\Throwable $e) {
            return response()->json(['ok' => false, 'message' => $e->getMessage()], 503);
        }
    }

    /**
     * Uji kirim pesan WhatsApp (Hybrid: kirim otomatis via Gateway jika Connected, atau buka wa.me langsung jika Offline)
     */
    public function testWhatsApp(Request $request, FonnteWhatsAppService $waService): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'test_phone' => ['required', 'string', 'max:40'],
            'test_message' => ['required', 'string', 'max:500'],
        ], [
            'test_phone.required' => 'Nomor WhatsApp tujuan uji wajib diisi.',
            'test_message.required' => 'Isi pesan uji wajib diisi.',
        ]);

        $target = SiteSetting::normalizePhone($validated['test_phone']);
        if ($target === '') {
            if ($request->expectsJson()) {
                return response()->json(['ok' => false, 'message' => 'Nomor WhatsApp tujuan tidak valid.'], 422);
            }
            return back()->with('admin_toast', [
                'type' => 'error',
                'title' => 'Nomor Tidak Valid',
                'message' => 'Masukkan nomor WhatsApp tujuan yang valid (contoh: 62857xxxxxxxx).',
            ]);
        }

        // Cek apakah Gateway aktif (lokal port 3001 atau Cloud API eksternal)
        if ($waService->isGatewayReachableForAutoSend()) {
            $res = $waService->sendTestMessage($target, $validated['test_message']);
            if ($res['ok']) {
                if ($request->expectsJson()) {
                    return response()->json(['ok' => true, 'mode' => 'gateway', 'message' => $res['message']]);
                }
                return back()->with('admin_toast', [
                    'type' => 'success',
                    'title' => 'Pesan Uji Terkirim Otomatis',
                    'message' => $res['message'],
                ]);
            }
        }

        $waUrl = 'https://wa.me/' . $target . '?text=' . rawurlencode($validated['test_message']);
        if ($request->expectsJson()) {
            return response()->json([
                'ok' => true,
                'mode' => 'direct',
                'wa_url' => $waUrl,
                'message' => "Gateway belum terhubung; membuka WhatsApp langsung ke {$target}.",
            ]);
        }

        return redirect()->away($waUrl);
    }
}
