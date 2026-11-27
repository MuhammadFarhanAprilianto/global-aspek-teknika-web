<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('login', 'auth.login')
        ->name('login');

    // Standard HTML POST login (Triggers native Edge/Chrome Password Manager + Rate Limited + No Plaintext Password Cookie)
    Route::post('login', function (\Illuminate\Http\Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $email = \Illuminate\Support\Str::lower(trim($credentials['email']));
        $throttleKey = \Illuminate\Support\Str::transliterate($email . '|' . $request->ip());

        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($throttleKey);
            $minutes = (int) ceil($seconds / 60);
            try {
                \App\Models\AdminSecurityLog::record('login_locked', 'danger', null, $email, "Terlalu banyak percobaan login. Terkunci selama {$seconds} detik.");
            } catch (\Throwable $e) {
            }
            return back()
                ->withErrors(['email' => "Terlalu banyak percobaan gagal. Coba lagi dalam {$minutes} menit ({$seconds} detik)."])
                ->withInput($request->only('email'));
        }

        $user = \App\Models\User::where('email', $email)->first();

        if (! $user || ! \Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
            \Illuminate\Support\Facades\RateLimiter::hit($throttleKey, 300);
            try {
                \App\Models\AdminSecurityLog::record('login_failed', 'danger', $user, $email, 'Percobaan login gagal (email atau kata sandi salah).');
            } catch (\Throwable $e) {
            }
            return back()->withErrors(['email' => 'Email atau kata sandi tidak valid.'])->withInput($request->only('email'));
        }

        if ($user->role !== 'admin' && ! ($user->is_admin ?? false)) {
            \Illuminate\Support\Facades\RateLimiter::hit($throttleKey, 300);
            return back()->withErrors(['email' => 'Akses ditolak. Portal ini khusus untuk Administrator PT Global Aspect Technology.'])->withInput($request->only('email'));
        }

        \Illuminate\Support\Facades\RateLimiter::clear($throttleKey);

        // Jika akun mengaktifkan 2FA, alihkan ke tantangan 2FA Livewire
        if ($user->hasTwoFactorEnabled()) {
            $request->session()->put('gat_pending_2fa_user_id', $user->id);
            $request->session()->put('gat_pending_2fa_remember', $request->boolean('remember'));
            return redirect()->route('login');
        }

        $remember = $request->boolean('remember');
        \Illuminate\Support\Facades\Auth::login($user, $remember);

        if ($remember) {
            $encryptedPayload = \Illuminate\Support\Facades\Crypt::encryptString(json_encode([
                'email' => $user->email,
            ]));
            \Illuminate\Support\Facades\Cookie::queue(cookie(
                name: 'gat_saved_credentials',
                value: $encryptedPayload,
                minutes: 43200,
                path: '/',
                domain: null,
                secure: $request->isSecure(),
                httpOnly: true,
                raw: false,
                sameSite: 'lax'
            ));
        } else {
            \Illuminate\Support\Facades\Cookie::queue(\Illuminate\Support\Facades\Cookie::forget('gat_saved_credentials'));
        }

        $request->session()->regenerate();
        $request->session()->put('admin_session_version', (int) ($user->session_version ?: 1));
        $request->session()->put('admin_last_activity', now()->timestamp);
        $request->session()->put('admin_session_synced_at', now()->timestamp);

        try {
            \App\Models\AdminActiveSession::syncCurrent($user, $request->session()->getId());
            \App\Models\AdminSecurityLog::record('login_success', 'success', $user, $user->email, 'Login berhasil ke portal Administrator.');
        } catch (\Throwable $e) {
        }

        return redirect()->intended(route('admin.dashboard', absolute: false));
    })->name('login.post');

    Route::get('admin/login', function () {
        return redirect()->route('login');
    })->name('admin.login');

    // Registrasi publik ditutup demi keamanan ketat portal Administrator
    Route::get('register', function () {
        return redirect()->route('login')->with('status', 'Pendaftaran akun publik dinonaktifkan. Hubungi Administrator PT Global Aspect Technology.');
    })->name('register');

    Volt::route('forgot-password', 'auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'auth.reset-password')
        ->name('password.reset');

});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'auth.confirm-password')
        ->name('password.confirm');
});

Route::post('logout', App\Livewire\Actions\Logout::class)
    ->name('logout');
