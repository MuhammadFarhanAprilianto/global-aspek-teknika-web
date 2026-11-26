<?php

namespace App\Http\Middleware;

use App\Models\VisitorLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Hanya catat permintaan GET yang berhasil (HTTP 200) berupa halaman HTML publik nyata
        if (! $request->isMethod('GET') || $response->getStatusCode() !== 200) {
            return $response;
        }

        $contentType = strtolower((string) $response->headers->get('Content-Type', ''));
        if (! str_contains($contentType, 'text/html')) {
            return $response;
        }

        // Abaikan API, admin, auth, livewire, asset, dan request fetch/XHR latar belakang
        if (
            $request->ajax() ||
            $request->expectsJson() ||
            $request->is('api*') ||
            $request->is('admin*') ||
            $request->is('dashboard*') ||
            $request->is('login*') ||
            $request->is('logout*') ||
            $request->is('register*') ||
            $request->is('forgot-password*') ||
            $request->is('reset-password*') ||
            $request->is('verify-email*') ||
            $request->is('confirm-password*') ||
            $request->is('settings*') ||
            $request->is('livewire*') ||
            $request->is('_debugbar*') ||
            $request->is('storage*') ||
            $request->is('build*') ||
            $request->is('images*') ||
            $request->is('up')
        ) {
            return $response;
        }

        // Abaikan prefetch/background fetch browser modern (hanya terima navigasi dokumen nyata)
        $secFetchDest = strtolower((string) $request->header('Sec-Fetch-Dest', ''));
        if ($secFetchDest !== '' && $secFetchDest !== 'document') {
            return $response;
        }
        if ($request->header('Purpose') === 'prefetch' || $request->header('Sec-Purpose') === 'prefetch') {
            return $response;
        }

        // Abaikan bot, crawler, dan skrip pengujian otomatis (curl/PowerShell/Python)
        $userAgent = (string) $request->userAgent();
        if (
            trim($userAgent) === '' ||
            preg_match('/(bot|crawl|spider|slurp|curl|wget|powershell|python|postman|insomnia|headless|lighthouse|uptime|monitor)/i', $userAgent)
        ) {
            return $response;
        }

        try {
            $ip = (string) $request->ip();
            $fullUrl = Str::limit($request->fullUrl(), 490);

            // Deduplikasi: 1 IP membuka URL yang sama dalam 15 menit terakhir hanya dihitung 1x
            $alreadyTrackedRecently = VisitorLog::where('ip_address', $ip)
                ->where('page_url', $fullUrl)
                ->where('created_at', '>=', now()->subMinutes(15))
                ->exists();

            if ($alreadyTrackedRecently) {
                return $response;
            }

            // Deteksi Device
            $device = 'Desktop';
            if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', $userAgent)) {
                $device = 'Tablet';
            } elseif (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $userAgent)) {
                $device = 'Mobile';
            }

            // Deteksi Browser
            $browser = 'Other';
            if (str_contains($userAgent, 'Edg')) {
                $browser = 'Edge';
            } elseif (str_contains($userAgent, 'Chrome')) {
                $browser = 'Chrome';
            } elseif (str_contains($userAgent, 'Safari')) {
                $browser = 'Safari';
            } elseif (str_contains($userAgent, 'Firefox')) {
                $browser = 'Firefox';
            } elseif (str_contains($userAgent, 'MSIE') || str_contains($userAgent, 'Trident/7')) {
                $browser = 'IE';
            }

            // Deteksi Platform / OS
            $platform = 'Other';
            if (str_contains($userAgent, 'Windows')) {
                $platform = 'Windows';
            } elseif (str_contains($userAgent, 'Macintosh') || str_contains($userAgent, 'Mac OS')) {
                $platform = 'macOS';
            } elseif (str_contains($userAgent, 'Linux')) {
                $platform = 'Linux';
            } elseif (str_contains($userAgent, 'Android')) {
                $platform = 'Android';
            } elseif (str_contains($userAgent, 'iPhone') || str_contains($userAgent, 'iPad')) {
                $platform = 'iOS';
            }

            VisitorLog::create([
                'ip_address' => $ip,
                'page_url' => $fullUrl,
                'route_name' => $request->route() ? $request->route()->getName() : null,
                'user_agent' => Str::limit($userAgent, 490),
                'device' => $device,
                'browser' => $browser,
                'platform' => $platform,
                'referer' => Str::limit((string) $request->header('referer'), 490),
            ]);
        } catch (\Throwable $e) {
            // Jangan gagalkan request pengunjung jika tracking gagal
        }

        return $response;
    }
}
