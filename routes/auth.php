<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('login', 'auth.login')
        ->name('login');

    // Safe POST fallback when JS/Livewire is delayed or blocked on cold serverless requests
    Route::post('login', function (\Illuminate\Http\Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $email = \Illuminate\Support\Str::lower(trim($credentials['email']));
        $user = \App\Models\User::where('email', $email)->first();

        if (! $user || ! \Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['email' => 'Email atau kata sandi tidak valid.'])->withInput($request->only('email'));
        }

        if ($user->role !== 'admin' && ! ($user->is_admin ?? false)) {
            return back()->withErrors(['email' => 'Akses ditolak. Portal ini khusus untuk Administrator PT Global Aspect Technology.']);
        }

        // If 2FA is enabled, fall back cleanly to Livewire 2FA screen
        if ($user->hasTwoFactorEnabled()) {
            return back()->with('status', 'Akun ini mengaktifkan 2FA. Silakan tunggu halaman selesai memuat lalu masuk kembali.');
        }

        $remember = $request->boolean('remember');
        \Illuminate\Support\Facades\Auth::login($user, $remember);

        if ($remember) {
            $encryptedPayload = \Illuminate\Support\Facades\Crypt::encryptString(json_encode([
                'email' => $user->email,
                'password' => $credentials['password'],
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
