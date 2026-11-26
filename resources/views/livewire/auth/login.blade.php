<?php

use App\Models\AdminActiveSession;
use App\Models\AdminSecurityLog;
use App\Models\User;
use App\Services\TotpService;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[
        Validate(
            'required|string|email',
            message: [
                'required' => 'Email wajib diisi.',
                'email' => 'Format email tidak valid.',
            ],
        ),
    ]
    public string $email = '';

    #[
        Validate(
            'required|string',
            message: [
                'required' => 'Password wajib diisi.',
            ],
        ),
    ]
    public string $password = '';

    public bool $remember = false;

    // 2FA Challenge State
    public bool $requiresTwoFactor = false;
    public ?int $pendingTwoFactorUserId = null;
    public string $twoFactorCode = '';

    /**
     * Bersihkan cookie lama yang tidak aman, lalu muat kredensial perangkat terenkripsi jika opsi "Ingat sesi saya" aktif.
     */
    public function mount(): void
    {
        if (request()->hasCookie('remember_admin_password')) {
            Cookie::queue(Cookie::forget('remember_admin_password'));
        }
        if (request()->hasCookie('remember_admin_email')) {
            Cookie::queue(Cookie::forget('remember_admin_email'));
        }

        if (session()->has('gat_pending_2fa_user_id')) {
            $this->pendingTwoFactorUserId = (int) session()->pull('gat_pending_2fa_user_id');
            $this->remember = (bool) session()->pull('gat_pending_2fa_remember', false);
            $this->requiresTwoFactor = true;
            return;
        }

        $rawSaved = request()->cookie('gat_saved_credentials');
        if (is_string($rawSaved) && $rawSaved !== '') {
            try {
                $decoded = json_decode(Crypt::decryptString($rawSaved), true);
                if (
                    is_array($decoded)
                    && ! empty($decoded['email'])
                    && ! empty($decoded['password'])
                    && is_string($decoded['email'])
                    && is_string($decoded['password'])
                ) {
                    $this->email = $decoded['email'];
                    $this->password = $decoded['password'];
                    $this->remember = true;
                }
            } catch (\Throwable $e) {
                Cookie::queue(Cookie::forget('gat_saved_credentials'));
            }
        }
        if (old('email')) {
            $this->email = (string) old('email');
        }
    }

    /**
     * Kembali ke form email & sandi dari tantangan 2FA.
     */
    public function cancelTwoFactor(): void
    {
        $this->requiresTwoFactor = false;
        $this->pendingTwoFactorUserId = null;
        $this->twoFactorCode = '';
        $this->resetValidation();
    }

    /**
     * Handle an incoming authentication request (Strict Rate Limit + Audit Log + Optional 2FA).
     */
    public function login(): void
    {
        $this->validate();
        $this->ensureIsNotRateLimited();

        $user = User::where('email', Str::lower(trim($this->email)))->first();

        if (! $user || ! Hash::check($this->password, $user->password)) {
            RateLimiter::hit($this->throttleKey(), 300);

            AdminSecurityLog::record(
                'login_failed',
                'danger',
                $user,
                $this->email,
                'Percobaan login gagal (email atau kata sandi salah).'
            );

            throw ValidationException::withMessages([
                'email' => 'Email atau kata sandi tidak valid.',
            ]);
        }

        // Pastikan hanya akun Administrator yang boleh masuk
        if ($user->role !== 'admin' && ! ($user->is_admin ?? false)) {
            RateLimiter::hit($this->throttleKey(), 300);

            AdminSecurityLog::record(
                'login_failed',
                'danger',
                $user,
                $this->email,
                'Percobaan login ditolak: akun bukan Administrator.'
            );

            throw ValidationException::withMessages([
                'email' => 'Akses ditolak. Portal ini khusus untuk Administrator PT Global Aspect Technology.',
            ]);
        }

        $plainPassword = $this->password;

        // Jika akun mengaktifkan 2FA, masuk ke tahap verifikasi kode 6-digit / Recovery Code
        if ($user->hasTwoFactorEnabled()) {
            $this->pendingTwoFactorUserId = $user->id;
            $this->requiresTwoFactor = true;
            session()->put('gat_pending_2fa_pass', Crypt::encryptString($plainPassword));
            $this->password = '';
            $this->twoFactorCode = '';
            $this->resetValidation();
            return;
        }

        $this->completeAdminLogin($user, 'Login berhasil ke portal Administrator.', $plainPassword);
    }

    /**
     * Verifikasi kode 2FA (6-digit TOTP Authenticator atau Kode Pemulihan 1x pakai).
     */
    public function verifyTwoFactor(): void
    {
        $this->validate([
            'twoFactorCode' => ['required', 'string', 'min:6', 'max:20'],
        ], [
            'twoFactorCode.required' => 'Masukkan kode 6 digit dari aplikasi Authenticator atau Kode Pemulihan.',
        ]);

        $this->ensureIsNotRateLimited();

        $user = $this->pendingTwoFactorUserId ? User::find($this->pendingTwoFactorUserId) : null;
        if (! $user || ! $user->hasTwoFactorEnabled()) {
            $this->cancelTwoFactor();
            throw ValidationException::withMessages([
                'email' => 'Sesi verifikasi 2FA tidak valid. Silakan login kembali.',
            ]);
        }

        $valid = false;
        $usedRecovery = false;

        try {
            $secret = Crypt::decryptString($user->two_factor_secret);
            $valid = TotpService::verifyCode($secret, $this->twoFactorCode);
        } catch (\Throwable $e) {
            $valid = false;
        }

        if (! $valid) {
            $remainingJson = TotpService::consumeRecoveryCode($user->two_factor_recovery_codes, $this->twoFactorCode);
            if ($remainingJson !== null) {
                $user->two_factor_recovery_codes = $remainingJson;
                $user->save();
                $valid = true;
                $usedRecovery = true;
            }
        }

        if (! $valid) {
            RateLimiter::hit($this->throttleKey(), 300);

            AdminSecurityLog::record(
                'login_2fa_failed',
                'danger',
                $user,
                $user->email,
                'Kode 2FA / Kode Pemulihan tidak cocok saat login.'
            );

            throw ValidationException::withMessages([
                'twoFactorCode' => 'Kode 2FA tidak valid atau sudah kedaluwarsa. Coba kode terbaru dari aplikasi Authenticator.',
            ]);
        }

        $plainPassword = null;
        $pendingEncrypted = session()->pull('gat_pending_2fa_pass');
        if (is_string($pendingEncrypted) && $pendingEncrypted !== '') {
            try {
                $plainPassword = Crypt::decryptString($pendingEncrypted);
            } catch (\Throwable $e) {
                $plainPassword = null;
            }
        }

        $this->completeAdminLogin(
            $user,
            $usedRecovery ? 'Login berhasil menggunakan Kode Pemulihan 2FA.' : 'Login berhasil dengan verifikasi 2FA Authenticator.',
            $plainPassword
        );
    }

    /**
     * Selesaikan sesi login, simpan/lupakan kredensial perangkat terenkripsi, & catat audit keamanan.
     */
    protected function completeAdminLogin(User $user, string $auditNote = 'Login berhasil ke portal Administrator.', ?string $plainPassword = null): void
    {
        Auth::login($user, $this->remember);

        if ($this->remember && is_string($plainPassword) && $plainPassword !== '') {
            $encryptedPayload = Crypt::encryptString(json_encode([
                'email' => $user->email,
                'password' => $plainPassword,
            ]));

            Cookie::queue(cookie(
                name: 'gat_saved_credentials',
                value: $encryptedPayload,
                minutes: 43200, // 30 hari per perangkat
                path: '/',
                domain: null,
                secure: request()->isSecure(),
                httpOnly: true,
                raw: false,
                sameSite: 'lax'
            ));
        } else {
            Cookie::queue(Cookie::forget('gat_saved_credentials'));
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        Session::put('admin_session_version', (int) ($user->session_version ?: 1));
        Session::put('admin_last_activity', now()->timestamp);
        Session::put('admin_session_synced_at', now()->timestamp);

        AdminActiveSession::syncCurrent($user, Session::getId());
        AdminSecurityLog::record('login_success', 'success', $user, $user->email, $auditNote);

        // Delay halus 500ms agar animasi Loading Infinity tampil mulus
        usleep(500000);

        $this->redirectIntended(default: route('admin.dashboard', absolute: false), navigate: false);
    }

    /**
     * Strict Rate Limiting: maksimal 5 percobaan gagal, terkunci 5 menit (300 detik).
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());
        $minutes = (int) ceil($seconds / 60);

        AdminSecurityLog::record(
            'login_locked',
            'danger',
            null,
            $this->email,
            "Terlalu banyak percobaan gagal. Terkunci selama {$seconds} detik."
        );

        throw ValidationException::withMessages([
            $this->requiresTwoFactor ? 'twoFactorCode' : 'email' => "Terlalu banyak percobaan gagal. Akun dikunci sementara selama {$minutes} menit ({$seconds} detik) demi keamanan.",
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}; ?>

<div class="relative min-h-screen w-full flex items-center justify-center p-4 sm:p-8 lg:p-14 bg-[#e8f1f9] bg-cover bg-center bg-no-repeat overflow-hidden"
    style="background-image: url('{{ asset('storage/BG_Login_Modern_4K.jpeg') }}');"
    x-data
    x-init="localStorage.removeItem('gat_remember_email'); localStorage.removeItem('gat_remember_pass');">

    <!-- Subtle Ambient Backdrop Filter for contrast -->
    <div class="absolute inset-0 bg-gradient-to-r from-white/40 via-white/10 to-transparent pointer-events-none"></div>

    <!-- Main Content Container: 2-Column Split matching reference -->
    <div
        class="relative z-10 w-full max-w-6xl mx-auto flex flex-col lg:flex-row items-center justify-between gap-10 lg:gap-16">

        <!-- Left Column: Company Branding & Showcase -->
        <div class="w-full lg:w-1/2 flex flex-col items-start space-y-6 text-left">
            <!-- Company Logo -->
            <a href="{{ route('home') }}" class="inline-block" title="PT Global Aspect Technology">
                <img src="{{ asset('storage/Logo_Perusahaan.webp') }}" alt="PT Global Aspect Technology"
                    class="h-20 sm:h-28 lg:h-36 xl:h-40 w-auto max-w-full object-contain drop-shadow-md">
            </a>

            <div class="space-y-2">
                <h1
                    class="text-3xl sm:text-4xl lg:text-5xl font-bold font-['Agrandir',sans-serif] text-slate-900 tracking-tight leading-tight">
                    PT Global Aspect Technology
                </h1>
                <p class="text-sm sm:text-base text-slate-600 font-['Questrial',sans-serif] max-w-md leading-relaxed">
                    Integrated Automation, Machine Vision Inspection, SCADA &amp; Industrial IoT Systems.
                </p>
            </div>
        </div>

        <!-- Right Column: Clean White Floating Login Card -->
        <div class="w-full lg:w-[420px] shrink-0">
            <div
                class="w-full bg-white/95 backdrop-blur-xl rounded-3xl p-7 sm:p-9 shadow-[0_20px_60px_rgba(0,0,0,0.12)] border border-white/80 space-y-6">

                <style>
                    input::-ms-reveal,
                    input::-ms-clear,
                    input[type="password"]::-ms-reveal,
                    input[type="password"]::-ms-clear {
                        display: none !important;
                        width: 0 !important;
                        height: 0 !important;
                        pointer-events: none !important;
                    }

                    @keyframes infinityFlow {
                        0% { stroke-dashoffset: 0; }
                        100% { stroke-dashoffset: -114.4; }
                    }

                    .infinity-track {
                        stroke: rgba(255, 255, 255, 0.35);
                        stroke-width: 4;
                        stroke-linecap: round;
                        stroke-linejoin: round;
                        fill: none;
                    }

                    .infinity-flow {
                        stroke: #ffffff;
                        stroke-width: 4;
                        stroke-linecap: round;
                        stroke-linejoin: round;
                        stroke-dasharray: 28 86.4;
                        animation: infinityFlow 1.1s linear infinite;
                        fill: none;
                        filter: drop-shadow(0 0 5px rgba(255, 255, 255, 0.95));
                    }
                </style>

                @if (! $requiresTwoFactor)
                    <!-- Card Header -->
                    <div class="space-y-1">
                        <h2
                            class="text-2xl sm:text-3xl font-bold font-['Agrandir',sans-serif] text-slate-900 tracking-tight">
                            Login</h2>
                        <p class="text-xs text-slate-500 font-['Questrial',sans-serif]">
                            Portal Administrator Terproteksi · PT Global Aspect Technology
                        </p>
                    </div>

                    <!-- Session Status Message -->
                    @if (session('status'))
                        <div
                            class="p-3 rounded-xl bg-amber-50 border border-amber-200 text-xs font-medium text-amber-800 text-center leading-relaxed">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Step 1: Standard POST Login Form (Enables native Edge/Chrome "Save Password?" & reliable serverless login) -->
                    <form method="POST" action="{{ route('login.post') }}" class="space-y-4" x-data="{ submitting: false }" @submit="submitting = true">
                        @csrf
                        <!-- Email Address Field -->
                        <div class="space-y-1.5">
                            <label for="email"
                                class="block text-xs font-bold text-slate-700 uppercase tracking-wider font-['Questrial',sans-serif]">Email</label>
                            <div class="relative">
                                <input type="email" id="email" name="email" value="{{ old('email', $email) }}" required autofocus
                                    autocomplete="username" placeholder="nama@perusahaan.co.id"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-sm text-slate-900 placeholder-slate-400 focus:bg-white focus:border-[#3367A5] focus:ring-2 focus:ring-[#3367A5]/20 outline-none transition font-['Questrial',sans-serif]">
                            </div>
                            @error('email')
                                <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Field with Show/Hide Eye Toggle -->
                        <div class="space-y-1.5" x-data="{ showPass: false }">
                            <label for="password"
                                class="block text-xs font-bold text-slate-700 uppercase tracking-wider font-['Questrial',sans-serif]">Password</label>
                            <div class="relative flex items-center">
                                <input :type="showPass ? 'text' : 'password'" id="password" name="password" value="{{ $password }}" required
                                    autocomplete="current-password" placeholder="••••••••••"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 pr-12 text-sm text-slate-900 placeholder-slate-400 focus:bg-white focus:border-[#3367A5] focus:ring-2 focus:ring-[#3367A5]/20 outline-none transition font-['Questrial',sans-serif]">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <button type="button" @click="showPass = !showPass"
                                        class="pointer-events-auto text-slate-400 hover:text-[#3367A5] focus:outline-none transition-colors duration-200 cursor-pointer flex items-center justify-center p-1 rounded-lg hover:bg-slate-100"
                                        title="Tampilkan / Sembunyikan Sandi">
                                        <svg x-show="!showPass" class="w-5 h-5 text-slate-400 hover:text-[#3367A5] transition" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                            <path d="M12 17c4.227 0 6.334-3.491 6.913-4.64a.8.8 0 0 0 0-.722C18.334 10.49 16.227 7 12 7s-6.334 3.49-6.913 4.638a.8.8 0 0 0 0 .723C5.666 13.509 7.773 17 12 17" />
                                            <circle cx="12" cy="11.999" r="2.5" />
                                        </svg>
                                        <svg x-show="showPass" x-cloak class="w-5 h-5 text-[#3367A5] transition" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                            <path d="M19.9999 15.5C18.0664 17.6534 15.2285 19 11.9999 19C7.31078 19 3.8221 14.8706 2.45604 12.955C2.15201 12.5287 2 12.3155 2 12C2 11.6845 2.15201 11.4713 2.45604 11.045C3.3323 9.81635 5.09311 7.74794 7.49992 6.5" />
                                            <path d="M9.5 8C10.2452 7.37191 11.0827 7 11.9999 7C14.7613 7 16.9999 9.23858 16.9999 12C16.9999 12.9172 16.628 13.7547 16 14.5" />
                                            <path d="M3 3l18 18" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            @error('password')
                                <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Encrypted Per-Device Remember Session & Browser Password Manager Support -->
                        <div class="flex flex-col gap-1 pt-1">
                            <label class="inline-flex items-center gap-2 cursor-pointer select-none">
                                <input type="checkbox" name="remember" value="1" {{ $remember ? 'checked' : '' }}
                                    class="w-4 h-4 rounded text-[#3367A5] focus:ring-[#3367A5] border-slate-300 cursor-pointer">
                                <span class="text-xs sm:text-sm text-slate-700 font-medium font-['Questrial',sans-serif]">Ingat sesi saya</span>
                            </label>
                            <p class="text-[11px] text-slate-400 font-['Questrial',sans-serif] pl-6">
                                Simpan sesi &amp; izinkan browser Edge/Chrome menyimpan akun agar login berikutnya tinggal klik.
                            </p>
                        </div>

                        <!-- Submit Button with Loading Infinity Animation -->
                        <div class="pt-2">
                            <button type="submit" :disabled="submitting"
                                class="w-full h-12 py-3 px-6 rounded-xl bg-[#3367A5] hover:bg-[#255187] text-white font-bold font-['Agrandir',sans-serif] text-sm tracking-wide shadow-lg shadow-[#3367A5]/25 hover:shadow-xl transition-all duration-300 active:scale-[0.99] flex items-center justify-center disabled:opacity-90 cursor-pointer overflow-hidden relative">
                                <span x-show="!submitting" class="transition-opacity duration-200">
                                    Masuk ke Dashboard
                                </span>
                                <span x-show="submitting" x-cloak class="inline-flex items-center justify-center transition-opacity duration-200">
                                    <svg class="w-10 h-5 text-white inline-block" viewBox="0 0 64 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path class="infinity-track" d="M18 8 C8 8, 4 12, 4 16 C4 20, 8 24, 18 24 C28 24, 36 8, 46 8 C56 8, 60 12, 60 16 C60 20, 56 24, 46 24 C36 24, 28 8, 18 8 Z" />
                                        <path class="infinity-flow" d="M18 8 C8 8, 4 12, 4 16 C4 20, 8 24, 18 24 C28 24, 36 8, 46 8 C56 8, 60 12, 60 16 C60 20, 56 24, 46 24 C36 24, 28 8, 18 8 Z" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </form>
                @else
                    <!-- Step 2: Strict 2FA Authenticator Challenge -->
                    <div class="space-y-1.5">
                        <div class="w-11 h-11 rounded-2xl bg-blue-50 text-[#3367A5] flex items-center justify-center mb-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <h2 class="text-xl sm:text-2xl font-bold font-['Agrandir',sans-serif] text-slate-900 tracking-tight">
                            Verifikasi 2FA
                        </h2>
                        <p class="text-xs text-slate-500 font-['Questrial',sans-serif] leading-relaxed">
                            Masukkan kode 6 digit dari aplikasi Google / Microsoft Authenticator Anda (atau gunakan Kode Pemulihan darurat).
                        </p>
                    </div>

                    <form wire:submit="verifyTwoFactor" class="space-y-4">
                        <div class="space-y-1.5">
                            <label for="twoFactorCode"
                                class="block text-xs font-bold text-slate-700 uppercase tracking-wider font-['Questrial',sans-serif]">Kode Authenticator / Pemulihan</label>
                            <input type="text" id="twoFactorCode" wire:model="twoFactorCode" required autofocus
                                autocomplete="one-time-code" placeholder="123456 atau XXXX-XXXX"
                                class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 text-center text-lg font-bold tracking-[0.25em] text-slate-900 placeholder-slate-400 focus:bg-white focus:border-[#3367A5] focus:ring-2 focus:ring-[#3367A5]/20 outline-none transition">
                            @error('twoFactorCode')
                                <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2 pt-1">
                            <button type="submit" wire:loading.attr="disabled"
                                class="w-full h-12 py-3 px-6 rounded-xl bg-[#3367A5] hover:bg-[#255187] text-white font-bold font-['Agrandir',sans-serif] text-sm tracking-wide shadow-lg shadow-[#3367A5]/25 transition flex items-center justify-center cursor-pointer">
                                <span wire:loading.remove wire:target="verifyTwoFactor">Verifikasi &amp; Masuk</span>
                                <span wire:loading wire:target="verifyTwoFactor">Memverifikasi...</span>
                            </button>
                            <button type="button" wire:click="cancelTwoFactor"
                                class="w-full py-2.5 text-xs font-semibold text-slate-500 hover:text-slate-800 transition cursor-pointer">
                                ← Kembali ke Login
                            </button>
                        </div>
                    </form>
                @endif

                <!-- Return to Home Link -->
                <div class="text-center pt-2 border-t border-slate-100">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center gap-1.5 text-xs text-slate-500 hover:text-[#3367A5] transition font-medium font-['Questrial',sans-serif]">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Kembali ke Beranda Utama</span>
                    </a>
                </div>

            </div>
        </div>

    </div>

</div>
