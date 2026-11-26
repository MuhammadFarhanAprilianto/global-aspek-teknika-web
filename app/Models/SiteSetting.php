<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class SiteSetting extends Model
{
    public const CACHE_KEY = 'gat_site_settings_all';

    protected $fillable = [
        'key',
        'group',
        'value',
    ];

    /**
     * Default settings used when a key has not yet been customized in DB.
     */
    public static function defaults(): array
    {
        return [
            // WhatsApp Gateway & Webhook
            'wa_gateway_enabled' => '1',
            'wa_gateway_mode' => 'local',
            'wa_gateway_endpoint' => (string) config('services.whatsapp.fonnte_endpoint', 'http://127.0.0.1:3001/send'),
            'wa_gateway_token' => (string) config('services.whatsapp.fonnte_token', 'gat-internal-wa-secret-2026'),
            'wa_admin_number' => (string) config('services.whatsapp.admin_number', '6285732021121'),
            'wa_public_number' => '6285280002573',
            'wa_send_copy_to_buyer' => config('services.whatsapp.send_copy_to_buyer', true) ? '1' : '0',
            'wa_webhook_url' => '',
            'wa_webhook_secret' => '',

            // Social Media & Public Contact Channels
            'social_linkedin' => 'https://www.linkedin.com/in/gat-aspect/',
            'social_instagram' => '',
            'social_youtube' => '',
            'social_facebook' => '',
            'social_tiktok' => '',
            'social_email' => 'admin@gat-aspect.com',

            // Per-channel visibility toggles (1 = Tampil di Popout & Footer, 0 = Disembunyikan)
            'social_linkedin_visible' => '1',
            'social_instagram_visible' => '0',
            'social_youtube_visible' => '0',
            'social_facebook_visible' => '0',
            'social_tiktok_visible' => '0',
            'social_email_visible' => '1',
        ];
    }

    /**
     * Load all settings merged with defaults (cached for fast public rendering).
     */
    public static function allMerged(): array
    {
        $defaults = self::defaults();

        try {
            if (! Schema::hasTable('site_settings')) {
                return $defaults;
            }

            $stored = Cache::remember(self::CACHE_KEY, 300, function () {
                return static::query()->pluck('value', 'key')->all();
            });

            return array_merge($defaults, $stored);
        } catch (\Throwable $e) {
            return $defaults;
        }
    }

    public static function getValue(string $key, mixed $default = null): mixed
    {
        $all = self::allMerged();
        if (array_key_exists($key, $all) && $all[$key] !== null) {
            return $all[$key];
        }

        return $default;
    }

    public static function setMany(string $group, array $pairs): void
    {
        foreach ($pairs as $key => $value) {
            static::updateOrCreate(
                ['key' => $key],
                [
                    'group' => $group,
                    'value' => is_bool($value) ? ($value ? '1' : '0') : ($value === null ? '' : (string) $value),
                ]
            );
        }

        Cache::forget(self::CACHE_KEY);
    }

    public static function normalizePhone(?string $raw): string
    {
        $digits = preg_replace('/\D+/', '', (string) $raw) ?: '';
        if (str_starts_with($digits, '0')) {
            return '62' . substr($digits, 1);
        }

        return $digits;
    }

    public static function adminWaNumber(): string
    {
        $num = self::normalizePhone((string) self::getValue('wa_admin_number', '6285732021121'));
        return $num !== '' ? $num : '6285732021121';
    }

    public static function publicWaNumber(): string
    {
        $num = self::normalizePhone((string) self::getValue('wa_public_number', '6285280002573'));
        return $num !== '' ? $num : '6285280002573';
    }

    public static function activeChannelsCount(): int
    {
        $all = self::allMerged();
        $count = 0;

        if (($all['wa_gateway_enabled'] ?? '0') === '1' && (trim((string) ($all['wa_admin_number'] ?? '')) !== '' || trim((string) ($all['wa_public_number'] ?? '')) !== '')) {
            $count++;
        }

        $count += count(self::activeSocialLinks());

        return $count;
    }

    /**
     * Check whether a specific social/contact channel is set to visible AND has a value.
     */
    public static function isSocialVisible(string $channel): bool
    {
        $all = self::allMerged();
        $val = trim((string) ($all["social_{$channel}"] ?? ''));
        if ($val === '') {
            return false;
        }

        return (string) ($all["social_{$channel}_visible"] ?? '1') === '1';
    }

    /**
     * Return active & visible social media links for public Footer & Floating FAB Popout.
     */
    public static function activeSocialLinks(): array
    {
        $all = self::allMerged();
        $map = [
            'linkedin' => [
                'label' => 'LinkedIn',
                'url' => trim((string) ($all['social_linkedin'] ?? '')),
                'visible' => (string) ($all['social_linkedin_visible'] ?? '1') === '1',
            ],
            'instagram' => [
                'label' => 'Instagram',
                'url' => trim((string) ($all['social_instagram'] ?? '')),
                'visible' => (string) ($all['social_instagram_visible'] ?? '0') === '1',
            ],
            'youtube' => [
                'label' => 'YouTube',
                'url' => trim((string) ($all['social_youtube'] ?? '')),
                'visible' => (string) ($all['social_youtube_visible'] ?? '0') === '1',
            ],
            'facebook' => [
                'label' => 'Facebook',
                'url' => trim((string) ($all['social_facebook'] ?? '')),
                'visible' => (string) ($all['social_facebook_visible'] ?? '0') === '1',
            ],
            'tiktok' => [
                'label' => 'TikTok',
                'url' => trim((string) ($all['social_tiktok'] ?? '')),
                'visible' => (string) ($all['social_tiktok_visible'] ?? '0') === '1',
            ],
        ];

        return array_filter($map, fn (array $item) => $item['visible'] && $item['url'] !== '');
    }
}
