<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'job_title',
        'avatar',
        'identity_verified_at',
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
        'session_version',
        'idle_timeout_minutes',
        'password_changed_at',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'identity_verified_at' => 'datetime',
            'two_factor_confirmed_at' => 'datetime',
            'password_changed_at' => 'datetime',
            'session_version' => 'integer',
            'idle_timeout_minutes' => 'integer',
            'password' => 'hashed',
        ];
    }

    public function hasTwoFactorEnabled(): bool
    {
        return !empty($this->two_factor_secret) && !is_null($this->two_factor_confirmed_at);
    }

    public function remainingRecoveryCodesCount(): int
    {
        if (empty($this->two_factor_recovery_codes)) {
            return 0;
        }
        $decoded = json_decode($this->two_factor_recovery_codes, true);
        return is_array($decoded) ? count($decoded) : 0;
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        $initials = Str::of($this->name ?: 'Admin')
            ->explode(' ')
            ->filter()
            ->take(2)
            ->map(fn (string $part) => Str::upper(Str::substr($part, 0, 1)))
            ->implode('');

        return $initials ?: 'AD';
    }

    /**
     * Verified public avatar URL or null if using corporate initials badge
     */
    public function avatarUrl(): ?string
    {
        if (empty($this->avatar)) {
            return null;
        }

        if (str_starts_with($this->avatar, 'http://') || str_starts_with($this->avatar, 'https://')) {
            return $this->avatar;
        }

        $clean = ltrim($this->avatar, '/');
        if (str_starts_with($clean, 'storage/')) {
            $clean = substr($clean, 8);
        }

        if (
            file_exists(base_path('storage/app/public/' . $clean)) ||
            file_exists(public_path('storage/' . $clean)) ||
            Storage::disk('public')->exists($clean)
        ) {
            return asset('storage/' . str_replace(' ', '%20', $clean));
        }

        return null;
    }

    /**
     * Whether admin identity is verified in database
     */
    public function isIdentityVerified(): bool
    {
        return !is_null($this->identity_verified_at);
    }

    /**
     * Real profile completion percentage based on database fields (20% per step)
     */
    public function profileCompletion(): int
    {
        $score = 0;
        if (!empty(trim((string) $this->name))) {
            $score += 20;
        }
        if (!empty(trim((string) $this->email))) {
            $score += 20;
        }
        if (!empty(trim((string) $this->phone))) {
            $score += 20;
        }
        if (!empty(trim((string) $this->job_title))) {
            $score += 20;
        }
        if ($this->isIdentityVerified()) {
            $score += 20;
        }

        return min(100, $score);
    }

    /**
     * Checklist of profile items for visual feedback in the verification modal
     */
    public function profileChecklist(): array
    {
        return [
            ['label' => 'Nama Lengkap', 'done' => !empty(trim((string) $this->name))],
            ['label' => 'Email Korporat', 'done' => !empty(trim((string) $this->email))],
            ['label' => 'WhatsApp Operasional', 'done' => !empty(trim((string) $this->phone))],
            ['label' => 'Jabatan / Divisi', 'done' => !empty(trim((string) $this->job_title))],
            ['label' => 'Verifikasi Identitas', 'done' => $this->isIdentityVerified()],
        ];
    }
}
