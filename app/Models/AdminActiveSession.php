<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminActiveSession extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'ip_address',
        'device_label',
        'user_agent',
        'last_active_at',
    ];

    protected function casts(): array
    {
        return [
            'last_active_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function syncCurrent(User $user, ?string $sessionId = null): void
    {
        $req = request();
        $sid = $sessionId ?: ($req ? $req->session()->getId() : null);
        if (!$sid) {
            return;
        }

        $ua = $req ? (string) $req->userAgent() : '';
        $ip = $req ? (string) $req->ip() : '127.0.0.1';

        static::updateOrCreate(
            ['session_id' => $sid],
            [
                'user_id' => $user->id,
                'ip_address' => mb_substr($ip, 0, 45),
                'device_label' => \App\Services\TotpService::parseDeviceLabel($ua),
                'user_agent' => mb_substr($ua, 0, 500),
                'last_active_at' => now(),
            ]
        );
    }
}
