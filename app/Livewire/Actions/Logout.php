<?php

namespace App\Livewire\Actions;

use App\Models\AdminActiveSession;
use App\Models\AdminSecurityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout
{
    /**
     * Log the current user out of the application & clean active session registry.
     */
    public function __invoke()
    {
        $user = Auth::guard('web')->user();
        $sessionId = Session::getId();

        if ($user) {
            try {
                AdminActiveSession::where('session_id', $sessionId)->delete();
                AdminSecurityLog::record('logout', 'success', $user, $user->email, 'Administrator keluar dari panel secara manual.');
            } catch (\Throwable $e) {
                // Fail-safe logout
            }
        }

        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        return redirect('/');
    }
}
