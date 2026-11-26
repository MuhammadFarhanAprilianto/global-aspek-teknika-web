<?php

namespace App\Http\Middleware;

use App\Models\AdminActiveSession;
use App\Models\AdminSecurityLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || ($user->role !== 'admin' && ! ($user->is_admin ?? false))) {
            abort(403, 'Akses ditolak. Hanya admin yang bisa mengakses.');
        }

        $isLivePolling = $request->routeIs('admin.api.live-traffic');
        $currentVersion = (int) ($user->session_version ?: 1);
        $sessionVersion = $request->session()->get('admin_session_version');

        // 1. Enforce global session version (revokes all other devices immediately)
        if ($sessionVersion === null) {
            $request->session()->put('admin_session_version', $currentVersion);
        } elseif ((int) $sessionVersion !== $currentVersion) {
            AdminActiveSession::where('session_id', $request->session()->getId())->delete();
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if ($request->expectsJson() || $isLivePolling) {
                return response()->json([
                    'expired' => true,
                    'reason' => 'session_revoked',
                    'redirect' => route('login'),
                ], 401);
            }

            return redirect()->route('login')->with('status', 'Sesi Anda telah diakhiri karena perubahan keamanan atau logout dari perangkat lain.');
        }

        // 2. Enforce Smart Idle Auto-Lock Timeout (0 = Disabled; live-traffic poll does NOT reset idle clock)
        $rawTimeout = $user->idle_timeout_minutes;
        $timeoutMinutes = is_null($rawTimeout) ? 120 : (int) $rawTimeout;
        $lastActivity = (int) $request->session()->get('admin_last_activity', 0);
        $now = now()->timestamp;

        // Allow 30s server grace buffer so client-side 60s countdown warning modal always completes smoothly
        if ($timeoutMinutes > 0 && $lastActivity > 0 && ($now - $lastActivity) > (($timeoutMinutes * 60) + 30)) {
            $humanDuration = $timeoutMinutes >= 60 ? ($timeoutMinutes / 60) . ' jam' : $timeoutMinutes . ' menit';
            AdminSecurityLog::record(
                'idle_timeout',
                'warning',
                $user,
                $user->email,
                "Auto-logout karena tidak ada aktivitas lebih dari {$humanDuration}."
            );
            AdminActiveSession::where('session_id', $request->session()->getId())->delete();
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if ($request->expectsJson() || $isLivePolling) {
                return response()->json([
                    'expired' => true,
                    'reason' => 'idle_timeout',
                    'redirect' => route('login'),
                ], 401);
            }

            return redirect()->route('login')->with('status', "Sesi Anda berakhir otomatis karena tidak ada aktivitas selama {$humanDuration} demi keamanan.");
        }

        if (! $isLivePolling) {
            $request->session()->put('admin_last_activity', $now);

            // Sync active session row (at most once per 60 seconds to keep requests fast)
            $lastSynced = (int) $request->session()->get('admin_session_synced_at', 0);
            if (($now - $lastSynced) >= 60) {
                try {
                    AdminActiveSession::syncCurrent($user, $request->session()->getId());
                    $request->session()->put('admin_session_synced_at', $now);
                } catch (\Throwable $e) {
                    // Fail-safe so admin panel never breaks if DB is momentarily busy
                }
            }
        }

        return $next($request);
    }
}
