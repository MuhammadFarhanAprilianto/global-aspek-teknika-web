<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminSecurityLog extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'event',
        'status',
        'ip_address',
        'device_label',
        'user_agent',
        'details',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function eventLabel(): string
    {
        return match ($this->event) {
            'login_success' => 'Login Berhasil',
            'login_failed' => 'Gagal Login (Sandi/Email Salah)',
            'login_2fa_failed' => 'Kode 2FA Tidak Valid',
            'login_locked' => 'Akun Terkunci Sementara',
            'password_changed' => 'Kata Sandi Diperbarui',
            'email_changed' => 'Email Login Diubah',
            '2fa_enabled' => '2FA Diaktifkan',
            '2fa_disabled' => '2FA Dinonaktifkan',
            'sessions_revoked' => 'Sesi Perangkat Lain Diputus',
            'idle_timeout' => 'Auto-Logout (Idle)',
            'logout' => 'Logout Manual',
            'admin_created' => 'Akun Admin Baru Dibuat',
            'admin_role_updated' => 'Status Akses Admin Diubah',
            'admin_password_reset' => 'Sandi Staf Admin Direset',
            'admin_deleted' => 'Akun Admin Dihapus',
            default => ucfirst(str_replace('_', ' ', $this->event)),
        };
    }

    public static function record(
        string $event,
        string $status = 'success',
        ?User $user = null,
        ?string $email = null,
        ?string $details = null,
        ?string $ip = null,
        ?string $userAgent = null
    ): self {
        $req = request();
        $ua = $userAgent ?? ($req ? (string) $req->userAgent() : '');
        $resolvedIp = $ip ?? ($req ? (string) $req->ip() : '127.0.0.1');

        return static::create([
            'user_id' => $user?->id,
            'email' => $email ?? $user?->email,
            'event' => $event,
            'status' => $status,
            'ip_address' => mb_substr($resolvedIp, 0, 45),
            'device_label' => \App\Services\TotpService::parseDeviceLabel($ua),
            'user_agent' => mb_substr($ua, 0, 500),
            'details' => $details,
        ]);
    }
}
