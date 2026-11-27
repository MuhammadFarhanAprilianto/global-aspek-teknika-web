<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\AdminActiveSession;
use App\Models\AdminSecurityLog;
use App\Models\User;
use App\Services\TotpService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminProfileController extends Controller
{
    /**
     * Lengkapi & verifikasi profil identitas administrator (tersimpan permanen di DB)
     */
    public function verify(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => ['required', 'string', 'max:50'],
            'job_title' => ['required', 'string', 'max:120'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [
            'name.required' => 'Nama lengkap administrator wajib diisi.',
            'email.required' => 'Email korporat wajib diisi.',
            'email.unique' => 'Email tersebut sudah digunakan oleh akun lain.',
            'phone.required' => 'Nomor WhatsApp operasional wajib diisi.',
            'job_title.required' => 'Jabatan atau divisi wajib diisi.',
            'avatar.image' => 'File foto profil harus berupa gambar (JPG, PNG, atau WebP).',
            'avatar.max' => 'Ukuran foto profil maksimal 2 MB.',
        ]);

        if ($request->hasFile('avatar')) {
            $cloudStorage = app(\App\Services\SupabaseStorageService::class);
            if ($user->avatar && (str_starts_with($user->avatar, 'avatars/') || str_contains($user->avatar, '/storage/v1/object/public/'))) {
                $cloudStorage->deleteStoredPath($user->avatar, 'public');
            }
            $user->avatar = $cloudStorage->storeUploadedFile($request->file('avatar'), 'avatars', 'public');
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->job_title = $validated['job_title'];
        $user->identity_verified_at = now();
        $user->save();

        return back()->with('admin_toast', [
            'type' => 'success',
            'title' => 'Profil Terverifikasi 100%',
            'message' => 'Identitas administrator dan data kontak operasional berhasil disimpan secara permanen.',
        ]);
    }

    /**
     * Perbarui profil, email (wajib verifikasi sandi), dan ganti kata sandi ketat
     */
    public function updateSettings(Request $request): RedirectResponse
    {
        $user = $request->user();
        $activeTab = $request->input('active_tab', 'profile');

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:50'],
            'job_title' => ['nullable', 'string', 'max:120'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'remove_avatar' => ['nullable', 'boolean'],
            'current_password' => ['nullable', 'string'],
            'new_password' => [
                'nullable',
                'string',
                'confirmed',
                Password::min(10)->mixedCase()->numbers()->symbols(),
            ],
        ];

        $validated = $request->validate($rules, [
            'name.required' => 'Nama tampilan wajib diisi.',
            'email.required' => 'Email administrator wajib diisi.',
            'email.unique' => 'Email sudah terdaftar pada akun lain.',
            'new_password.min' => 'Kata sandi baru minimal 10 karakter.',
            'new_password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        $emailChanged = strcasecmp(trim($validated['email']), trim((string) $user->email)) !== 0;
        $passwordChanged = !empty($validated['new_password']);

        // STRICT: Mengubah email login atau kata sandi WAJIB verifikasi Kata Sandi Saat Ini
        if ($emailChanged || $passwordChanged) {
            if (empty($validated['current_password']) || !Hash::check($validated['current_password'], $user->password)) {
                return back()
                    ->withInput($request->except(['current_password', 'new_password', 'new_password_confirmation']))
                    ->with('admin_modal', 'settings')
                    ->with('admin_settings_tab', $passwordChanged ? 'security' : 'profile')
                    ->with('admin_toast', [
                        'type' => 'error',
                        'title' => 'Verifikasi Sandi Gagal',
                        'message' => $emailChanged
                            ? 'Masukkan Kata Sandi Saat Ini yang benar untuk mengubah Email Login Administrator.'
                            : 'Masukkan Kata Sandi Saat Ini yang benar untuk mengganti kata sandi.',
                    ]);
            }
        }

        // STRICT: Tolak kata sandi baru yang sama dengan sandi lama
        if ($passwordChanged && Hash::check($validated['new_password'], $user->password)) {
            return back()
                ->withInput($request->except(['current_password', 'new_password', 'new_password_confirmation']))
                ->with('admin_modal', 'settings')
                ->with('admin_settings_tab', 'security')
                ->with('admin_toast', [
                    'type' => 'error',
                    'title' => 'Sandi Baru Sama dengan Lama',
                    'message' => 'Demi keamanan, gunakan kombinasi kata sandi baru yang berbeda dari sandi sebelumnya.',
                ]);
        }

        if ($request->boolean('remove_avatar') && $user->avatar) {
            if (str_starts_with($user->avatar, 'avatars/') || str_contains($user->avatar, '/storage/v1/object/public/')) {
                app(\App\Services\SupabaseStorageService::class)->deleteStoredPath($user->avatar, 'public');
            }
            $user->avatar = null;
        }

        if ($request->hasFile('avatar')) {
            $cloudStorage = app(\App\Services\SupabaseStorageService::class);
            if ($user->avatar && (str_starts_with($user->avatar, 'avatars/') || str_contains($user->avatar, '/storage/v1/object/public/'))) {
                $cloudStorage->deleteStoredPath($user->avatar, 'public');
            }
            $user->avatar = $cloudStorage->storeUploadedFile($request->file('avatar'), 'avatars', 'public');
        }

        $oldEmail = $user->email;
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? $user->phone;
        $user->job_title = $validated['job_title'] ?? $user->job_title;

        if ($passwordChanged) {
            $user->password = $validated['new_password'];
            $user->password_changed_at = now();
        }

        // Putus paksa semua sesi perangkat lain jika Email atau Sandi diubah
        if ($emailChanged || $passwordChanged) {
            $user->session_version = ((int) ($user->session_version ?: 1)) + 1;
        }

        $user->save();

        if ($emailChanged || $passwordChanged) {
            $request->session()->regenerate();
            $currentSid = $request->session()->getId();
            $request->session()->put('admin_session_version', (int) $user->session_version);
            $request->session()->put('admin_last_activity', now()->timestamp);

            AdminActiveSession::where('user_id', $user->id)
                ->where('session_id', '!=', $currentSid)
                ->delete();
            AdminActiveSession::syncCurrent($user, $currentSid);

            try {
                Auth::logoutOtherDevices($passwordChanged ? $validated['new_password'] : $validated['current_password']);
            } catch (\Throwable $e) {
                // session_version check in IsAdmin already guarantees instant revocation
            }

            if ($emailChanged) {
                AdminSecurityLog::record('email_changed', 'warning', $user, $user->email, "Email diubah dari {$oldEmail} ke {$user->email}. Sesi lain diputus.");
            }
            if ($passwordChanged) {
                AdminSecurityLog::record('password_changed', 'success', $user, $user->email, 'Kata sandi administrator diperbarui. Semua sesi perangkat lain diputus.');
            }
        }

        $msg = match (true) {
            $passwordChanged && $emailChanged => 'Email login & kata sandi diperbarui. Semua sesi perangkat lain telah diputus otomatis.',
            $passwordChanged => 'Kata sandi kuat berhasil diperbarui & semua sesi perangkat lain telah diputus.',
            $emailChanged => 'Email login administrator berhasil diperbarui & semua sesi lain telah diputus.',
            default => 'Pengaturan profil akun administrator berhasil disimpan.',
        };

        return back()
            ->with('admin_settings_tab', $activeTab)
            ->with('admin_toast', [
                'type' => 'success',
                'title' => 'Pengaturan Tersimpan',
                'message' => $msg,
            ]);
    }

    /**
     * Generate temporary TOTP 2FA secret + inline QR Code SVG (JSON)
     */
    public function setupTwoFactor(Request $request): JsonResponse
    {
        $user = $request->user();
        $secret = TotpService::generateSecret();
        $otpAuthUri = TotpService::buildOtpAuthUri($user->email, $secret);
        $qrSvg = TotpService::renderQrCodeDataUri($otpAuthUri);

        $request->session()->put('pending_2fa_secret', $secret);

        return response()->json([
            'secret' => $secret,
            'formatted_secret' => trim(chunk_split($secret, 4, ' ')),
            'qr_svg' => $qrSvg,
        ]);
    }

    /**
     * Konfirmasi & aktifkan 2FA dengan verifikasi Kata Sandi + Kode OTP 6-digit
     */
    public function confirmTwoFactor(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'code' => ['required', 'string', 'min:6', 'max:10'],
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi untuk mengaktifkan 2FA.',
            'code.required' => 'Masukkan kode 6 digit dari aplikasi Authenticator Anda.',
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()
                ->with('admin_modal', 'settings')
                ->with('admin_settings_tab', 'security')
                ->with('admin_toast', [
                    'type' => 'error',
                    'title' => 'Kata Sandi Salah',
                    'message' => 'Kata sandi saat ini tidak cocok. Aktivasi 2FA dibatalkan.',
                ]);
        }

        $pendingSecret = (string) $request->session()->get('pending_2fa_secret', '');
        if ($pendingSecret === '') {
            return back()
                ->with('admin_modal', 'settings')
                ->with('admin_settings_tab', 'security')
                ->with('admin_toast', [
                    'type' => 'error',
                    'title' => 'Sesi QR Kedaluwarsa',
                    'message' => 'Silakan klik tombol Aktifkan 2FA kembali untuk membuat QR Code baru.',
                ]);
        }

        if (!TotpService::verifyCode($pendingSecret, $validated['code'])) {
            return back()
                ->with('admin_modal', 'settings')
                ->with('admin_settings_tab', 'security')
                ->with('admin_toast', [
                    'type' => 'error',
                    'title' => 'Kode OTP Tidak Cocok',
                    'message' => 'Pastikan jam HP Anda sinkron otomatis lalu masukkan 6 digit terbaru dari Authenticator.',
                ]);
        }

        $plainRecoveryCodes = TotpService::generateRecoveryCodes(8);

        $user->two_factor_secret = Crypt::encryptString($pendingSecret);
        $user->two_factor_recovery_codes = TotpService::hashRecoveryCodes($plainRecoveryCodes);
        $user->two_factor_confirmed_at = now();
        $user->save();

        $request->session()->forget('pending_2fa_secret');

        AdminSecurityLog::record('2fa_enabled', 'success', $user, $user->email, 'Autentikasi Dua Faktor (TOTP Authenticator) diaktifkan.');

        return back()
            ->with('admin_modal', 'settings')
            ->with('admin_settings_tab', 'security')
            ->with('new_recovery_codes', $plainRecoveryCodes)
            ->with('admin_toast', [
                'type' => 'success',
                'title' => '2FA Berhasil Diaktifkan',
                'message' => 'Simpan 8 Kode Pemulihan darurat di tempat aman sebelum menutup jendela ini.',
            ]);
    }

    /**
     * Nonaktifkan 2FA (wajib Kata Sandi + Kode OTP / Recovery Code)
     */
    public function disableTwoFactor(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'code' => ['required', 'string'],
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'code.required' => 'Masukkan kode 6 digit Authenticator atau Kode Pemulihan.',
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()
                ->with('admin_modal', 'settings')
                ->with('admin_settings_tab', 'security')
                ->with('admin_toast', [
                    'type' => 'error',
                    'title' => 'Kata Sandi Salah',
                    'message' => 'Kata sandi saat ini tidak valid.',
                ]);
        }

        $validOtp = false;
        if ($user->two_factor_secret) {
            try {
                $secret = Crypt::decryptString($user->two_factor_secret);
                $validOtp = TotpService::verifyCode($secret, $validated['code']);
            } catch (\Throwable $e) {
                $validOtp = false;
            }
        }
        if (!$validOtp) {
            $validOtp = TotpService::consumeRecoveryCode($user->two_factor_recovery_codes, $validated['code']) !== null;
        }

        if (!$validOtp) {
            return back()
                ->with('admin_modal', 'settings')
                ->with('admin_settings_tab', 'security')
                ->with('admin_toast', [
                    'type' => 'error',
                    'title' => 'Kode Verifikasi Salah',
                    'message' => 'Kode 6 digit Authenticator atau Kode Pemulihan tidak cocok.',
                ]);
        }

        $user->two_factor_secret = null;
        $user->two_factor_recovery_codes = null;
        $user->two_factor_confirmed_at = null;
        $user->save();

        AdminSecurityLog::record('2fa_disabled', 'warning', $user, $user->email, 'Autentikasi Dua Faktor (2FA) dinonaktifkan oleh administrator.');

        return back()
            ->with('admin_modal', 'settings')
            ->with('admin_settings_tab', 'security')
            ->with('admin_toast', [
                'type' => 'success',
                'title' => '2FA Dinonaktifkan',
                'message' => 'Autentikasi Dua Faktor telah dinonaktifkan dari akun ini.',
            ]);
    }

    /**
     * Simpan pengaturan Smart Auto-Lock Idle Timeout (0 = Nonaktif)
     */
    public function updateIdleTimeout(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'idle_timeout_minutes' => ['required', 'integer', 'in:0,30,60,120,240'],
        ]);

        $minutes = (int) $validated['idle_timeout_minutes'];
        $user->idle_timeout_minutes = $minutes;
        $user->save();

        $request->session()->put('admin_last_activity', now()->timestamp);

        $label = match ($minutes) {
            0 => 'Smart Auto-Lock dinonaktifkan. Sesi akan tetap masuk selama browser aktif.',
            30 => 'Smart Auto-Lock diatur ke 30 menit dengan peringatan 60 detik sebelum keluar.',
            60 => 'Smart Auto-Lock diatur ke 1 jam dengan peringatan 60 detik sebelum keluar.',
            120 => 'Smart Auto-Lock diatur ke 2 jam dengan peringatan 60 detik sebelum keluar.',
            240 => 'Smart Auto-Lock diatur ke 4 jam dengan peringatan 60 detik sebelum keluar.',
            default => "Smart Auto-Lock diatur ke {$minutes} menit.",
        };

        return back()
            ->with('admin_modal', 'settings')
            ->with('admin_settings_tab', 'sessions')
            ->with('admin_toast', [
                'type' => 'success',
                'title' => 'Smart Auto-Lock Diperbarui',
                'message' => $label,
            ]);
    }

    /**
     * Heartbeat aktivitas mouse/keyboard agar sesi tidak logout saat admin sedang mengetik form panjang
     */
    public function heartbeat(Request $request): JsonResponse
    {
        $request->session()->put('admin_last_activity', now()->timestamp);

        return response()->json([
            'ok' => true,
            'last_activity' => now()->timestamp,
        ]);
    }

    /**
     * Putus paksa semua sesi di perangkat/browser lain (wajib konfirmasi sandi)
     */
    public function revokeOtherSessions(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'current_password' => ['required', 'string'],
        ], [
            'current_password.required' => 'Masukkan kata sandi saat ini untuk memutus sesi perangkat lain.',
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()
                ->with('admin_modal', 'settings')
                ->with('admin_settings_tab', 'sessions')
                ->with('admin_toast', [
                    'type' => 'error',
                    'title' => 'Kata Sandi Salah',
                    'message' => 'Verifikasi sandi gagal. Sesi lain tidak diubah.',
                ]);
        }

        $user->session_version = ((int) ($user->session_version ?: 1)) + 1;
        $user->save();

        $request->session()->regenerate();
        $currentSid = $request->session()->getId();
        $request->session()->put('admin_session_version', (int) $user->session_version);
        $request->session()->put('admin_last_activity', now()->timestamp);

        $deleted = AdminActiveSession::where('user_id', $user->id)
            ->where('session_id', '!=', $currentSid)
            ->delete();
        AdminActiveSession::syncCurrent($user, $currentSid);

        try {
            Auth::logoutOtherDevices($validated['current_password']);
        } catch (\Throwable $e) {
            // Covered by session_version enforcement
        }

        AdminSecurityLog::record('sessions_revoked', 'warning', $user, $user->email, "Memutus paksa {$deleted} sesi perangkat lain.");

        return back()
            ->with('admin_modal', 'settings')
            ->with('admin_settings_tab', 'sessions')
            ->with('admin_toast', [
                'type' => 'success',
                'title' => 'Sesi Lain Diputus',
                'message' => 'Semua perangkat/browser lain telah dikeluarkan secara paksa.',
            ]);
    }

    /**
     * Tambah Akun Admin / Staf Baru (Multi-Admin, wajib verifikasi sandi admin saat ini)
     */
    public function storeAdmin(Request $request): RedirectResponse
    {
        $actor = $request->user();

        $validated = $request->validate([
            'new_admin_name' => ['required', 'string', 'max:255'],
            'new_admin_email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'new_admin_job_title' => ['nullable', 'string', 'max:120'],
            'new_admin_phone' => ['nullable', 'string', 'max:50'],
            'new_admin_password' => ['required', 'string', Password::min(8)->mixedCase()->numbers()],
            'current_password' => ['required', 'string'],
        ], [
            'new_admin_name.required' => 'Nama lengkap akun admin baru wajib diisi.',
            'new_admin_email.required' => 'Email login akun admin baru wajib diisi.',
            'new_admin_email.unique' => 'Email tersebut sudah terdaftar di sistem.',
            'new_admin_password.required' => 'Kata sandi akun admin baru wajib diisi.',
            'new_admin_password.min' => 'Kata sandi akun baru minimal 8 karakter (huruf besar, kecil, dan angka).',
            'current_password.required' => 'Konfirmasi kata sandi Anda saat ini wajib diisi.',
        ]);

        if (!Hash::check($validated['current_password'], $actor->password)) {
            return back()
                ->withInput($request->except(['current_password', 'new_admin_password']))
                ->with('admin_modal', 'settings')
                ->with('admin_settings_tab', 'admins')
                ->with('admin_toast', [
                    'type' => 'error',
                    'title' => 'Verifikasi Sandi Gagal',
                    'message' => 'Kata sandi Anda saat ini tidak cocok. Pembuatan akun admin baru dibatalkan.',
                ]);
        }

        $created = User::create([
            'name' => trim($validated['new_admin_name']),
            'email' => strtolower(trim($validated['new_admin_email'])),
            'job_title' => trim((string) ($validated['new_admin_job_title'] ?? '')) ?: 'Admin Staf',
            'phone' => trim((string) ($validated['new_admin_phone'] ?? '')) ?: null,
            'password' => $validated['new_admin_password'],
            'role' => 'admin',
            'identity_verified_at' => now(),
            'session_version' => 1,
            'idle_timeout_minutes' => 120,
            'password_changed_at' => now(),
        ]);

        AdminSecurityLog::record('admin_created', 'success', $actor, $actor->email, "Menambahkan akun admin baru: {$created->name} ({$created->email}).");

        return back()
            ->with('admin_modal', 'settings')
            ->with('admin_settings_tab', 'admins')
            ->with('admin_toast', [
                'type' => 'success',
                'title' => 'Akun Admin Dibuat',
                'message' => "Akun {$created->name} ({$created->email}) berhasil dibuat dan siap digunakan untuk login.",
            ]);
    }

    /**
     * Aktifkan / Nonaktifkan akses login portal Admin milik staf lain
     */
    public function toggleAdminRole(Request $request, User $user): RedirectResponse
    {
        $actor = $request->user();

        if ($user->id === $actor->id) {
            return back()
                ->with('admin_modal', 'settings')
                ->with('admin_settings_tab', 'admins')
                ->with('admin_toast', [
                    'type' => 'error',
                    'title' => 'Tidak Diizinkan',
                    'message' => 'Anda tidak dapat menonaktifkan akun Anda sendiri.',
                ]);
        }

        $willBeAdmin = $user->role !== 'admin';
        if (!$willBeAdmin && User::where('role', 'admin')->count() <= 1) {
            return back()
                ->with('admin_modal', 'settings')
                ->with('admin_settings_tab', 'admins')
                ->with('admin_toast', [
                    'type' => 'error',
                    'title' => 'Aksi Ditolak',
                    'message' => 'Minimal harus ada 1 akun Administrator yang aktif di sistem.',
                ]);
        }

        $user->role = $willBeAdmin ? 'admin' : 'user';
        $user->session_version = ((int) ($user->session_version ?: 1)) + 1;
        $user->save();

        if (!$willBeAdmin) {
            AdminActiveSession::where('user_id', $user->id)->delete();
        }

        $statusLabel = $willBeAdmin ? 'diaktifkan kembali sebagai Admin' : 'dinonaktifkan dari akses Admin';
        AdminSecurityLog::record('admin_role_updated', 'warning', $actor, $actor->email, "Akses akun {$user->email} {$statusLabel}.");

        return back()
            ->with('admin_modal', 'settings')
            ->with('admin_settings_tab', 'admins')
            ->with('admin_toast', [
                'type' => 'success',
                'title' => 'Status Akun Diperbarui',
                'message' => "Akun {$user->name} berhasil {$statusLabel}.",
            ]);
    }

    /**
     * Reset kata sandi akun staf/admin lain (wajib konfirmasi sandi Anda saat ini)
     */
    public function resetAdminPassword(Request $request, User $user): RedirectResponse
    {
        $actor = $request->user();

        if ($user->id === $actor->id) {
            return back()
                ->with('admin_modal', 'settings')
                ->with('admin_settings_tab', 'security')
                ->with('admin_toast', [
                    'type' => 'info',
                    'title' => 'Gunakan Tab Sandi & 2FA',
                    'message' => 'Untuk mengganti sandi akun Anda sendiri, gunakan tab Sandi & 2FA.',
                ]);
        }

        $validated = $request->validate([
            'reset_password' => ['required', 'string', Password::min(8)->mixedCase()->numbers()],
            'current_password' => ['required', 'string'],
        ], [
            'reset_password.required' => 'Kata sandi baru untuk akun staf wajib diisi.',
            'reset_password.min' => 'Kata sandi baru minimal 8 karakter (huruf besar, kecil, dan angka).',
            'current_password.required' => 'Konfirmasi kata sandi Anda saat ini wajib diisi.',
        ]);

        if (!Hash::check($validated['current_password'], $actor->password)) {
            return back()
                ->with('admin_modal', 'settings')
                ->with('admin_settings_tab', 'admins')
                ->with('admin_toast', [
                    'type' => 'error',
                    'title' => 'Kata Sandi Salah',
                    'message' => 'Verifikasi kata sandi Anda saat ini gagal.',
                ]);
        }

        $user->password = $validated['reset_password'];
        $user->password_changed_at = now();
        $user->session_version = ((int) ($user->session_version ?: 1)) + 1;
        $user->save();

        AdminActiveSession::where('user_id', $user->id)->delete();
        AdminSecurityLog::record('admin_password_reset', 'warning', $actor, $actor->email, "Mereset kata sandi akun {$user->email}.");

        return back()
            ->with('admin_modal', 'settings')
            ->with('admin_settings_tab', 'admins')
            ->with('admin_toast', [
                'type' => 'success',
                'title' => 'Kata Sandi Direset',
                'message' => "Kata sandi baru untuk {$user->name} berhasil diterapkan.",
            ]);
    }

    /**
     * Hapus akun admin/staf lain secara permanen
     */
    public function destroyAdmin(Request $request, User $user): RedirectResponse
    {
        $actor = $request->user();

        if ($user->id === $actor->id) {
            return back()
                ->with('admin_modal', 'settings')
                ->with('admin_settings_tab', 'admins')
                ->with('admin_toast', [
                    'type' => 'error',
                    'title' => 'Tidak Diizinkan',
                    'message' => 'Anda tidak dapat menghapus akun Anda sendiri.',
                ]);
        }

        if ($user->role === 'admin' && User::where('role', 'admin')->count() <= 1) {
            return back()
                ->with('admin_modal', 'settings')
                ->with('admin_settings_tab', 'admins')
                ->with('admin_toast', [
                    'type' => 'error',
                    'title' => 'Aksi Ditolak',
                    'message' => 'Tidak dapat menghapus akun Administrator terakhir.',
                ]);
        }

        $deletedEmail = $user->email;
        $deletedName = $user->name;
        AdminActiveSession::where('user_id', $user->id)->delete();
        $user->delete();

        AdminSecurityLog::record('admin_deleted', 'warning', $actor, $actor->email, "Menghapus akun admin {$deletedName} ({$deletedEmail}).");

        return back()
            ->with('admin_modal', 'settings')
            ->with('admin_settings_tab', 'admins')
            ->with('admin_toast', [
                'type' => 'success',
                'title' => 'Akun Dihapus',
                'message' => "Akun {$deletedName} ({$deletedEmail}) berhasil dihapus dari sistem.",
            ]);
    }
}
