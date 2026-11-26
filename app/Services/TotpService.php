<?php

namespace App\Services;

use chillerlan\QRCode\Output\QRMarkupSVG;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Support\Facades\Hash;

class TotpService
{
    private const BASE32_ALPHABET = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';

    /**
     * Generate a cryptographically secure Base32 TOTP secret (160-bit / 32 chars).
     */
    public static function generateSecret(int $bytes = 20): string
    {
        $random = random_bytes($bytes);
        return self::base32Encode($random);
    }

    /**
     * Build standard otpauth:// URI for Google Authenticator / Microsoft Authenticator / Authy.
     */
    public static function buildOtpAuthUri(string $email, string $secret, string $issuer = 'PT Global Aspect Technology'): string
    {
        $label = rawurlencode($issuer . ':' . $email);
        $params = http_build_query([
            'secret' => $secret,
            'issuer' => $issuer,
            'algorithm' => 'SHA1',
            'digits' => 6,
            'period' => 30,
        ]);

        return 'otpauth://totp/' . $label . '?' . $params;
    }

    /**
     * Render crisp SVG Data-URI QR code locally using chillerlan/php-qrcode.
     */
    public static function renderQrCodeDataUri(string $otpAuthUri): string
    {
        $options = new QROptions([
            'outputInterface' => QRMarkupSVG::class,
            'outputBase64' => true,
            'scale' => 6,
            'quietzoneSize' => 2,
            'svgAddXmlHeader' => false,
        ]);

        return (new QRCode($options))->render($otpAuthUri);
    }

    /**
     * Verify a 6-digit RFC 6238 TOTP code with ±1 time-step (30s) tolerance.
     */
    public static function verifyCode(string $base32Secret, string $code, int $window = 1, int $period = 30): bool
    {
        $cleanCode = preg_replace('/\D/', '', trim($code));
        if (strlen($cleanCode) !== 6) {
            return false;
        }

        $secretKey = self::base32Decode($base32Secret);
        if ($secretKey === '') {
            return false;
        }

        $currentSlice = (int) floor(time() / $period);
        for ($i = -$window; $i <= $window; $i++) {
            $calculated = self::generateTotpAtSlice($secretKey, $currentSlice + $i);
            if (hash_equals($calculated, $cleanCode)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Generate 8 human-readable one-time recovery codes (e.g. "ABCD-9F2K").
     */
    public static function generateRecoveryCodes(int $count = 8): array
    {
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $codes = [];
        for ($i = 0; $i < $count; $i++) {
            $p1 = '';
            $p2 = '';
            for ($j = 0; $j < 4; $j++) {
                $p1 .= $chars[random_int(0, strlen($chars) - 1)];
                $p2 .= $chars[random_int(0, strlen($chars) - 1)];
            }
            $codes[] = $p1 . '-' . $p2;
        }

        return $codes;
    }

    /**
     * Hash recovery codes for safe DB persistence.
     */
    public static function hashRecoveryCodes(array $plainCodes): string
    {
        $hashed = array_map(fn (string $code) => Hash::make(strtoupper(trim($code))), $plainCodes);
        return json_encode(array_values($hashed));
    }

    /**
     * Verify and consume a one-time recovery code. Returns remaining JSON string or null if invalid.
     */
    public static function consumeRecoveryCode(?string $hashedJson, string $inputCode): ?string
    {
        if (empty($hashedJson)) {
            return null;
        }

        $hashes = json_decode($hashedJson, true);
        if (!is_array($hashes)) {
            return null;
        }

        $normalized = strtoupper(trim($inputCode));
        foreach ($hashes as $idx => $hash) {
            if (is_string($hash) && Hash::check($normalized, $hash)) {
                unset($hashes[$idx]);
                return json_encode(array_values($hashes));
            }
        }

        return null;
    }

    /**
     * Parse concise browser + OS label from User-Agent string.
     */
    public static function parseDeviceLabel(?string $ua): string
    {
        $ua = (string) $ua;
        if ($ua === '') {
            return 'Unknown Device';
        }

        $browser = 'Browser';
        if (str_contains($ua, 'Edg/')) {
            $browser = 'Edge';
        } elseif (str_contains($ua, 'OPR/') || str_contains($ua, 'Opera')) {
            $browser = 'Opera';
        } elseif (str_contains($ua, 'Chrome/') && !str_contains($ua, 'Chromium')) {
            $browser = 'Chrome';
        } elseif (str_contains($ua, 'Firefox/')) {
            $browser = 'Firefox';
        } elseif (str_contains($ua, 'Safari/') && !str_contains($ua, 'Chrome')) {
            $browser = 'Safari';
        }

        $os = 'Desktop';
        if (str_contains($ua, 'Windows')) {
            $os = 'Windows';
        } elseif (str_contains($ua, 'iPhone') || str_contains($ua, 'iPad')) {
            $os = 'iOS';
        } elseif (str_contains($ua, 'Android')) {
            $os = 'Android';
        } elseif (str_contains($ua, 'Macintosh') || str_contains($ua, 'Mac OS')) {
            $os = 'macOS';
        } elseif (str_contains($ua, 'Linux')) {
            $os = 'Linux';
        }

        return $browser . ' · ' . $os;
    }

    private static function generateTotpAtSlice(string $secretKey, int $slice): string
    {
        $time = pack('N*', 0) . pack('N*', $slice);
        $hash = hash_hmac('sha1', $time, $secretKey, true);
        $offset = ord(substr($hash, -1)) & 0x0F;
        $truncated = unpack('N', substr($hash, $offset, 4))[1] & 0x7FFFFFFF;
        $code = $truncated % 1000000;

        return str_pad((string) $code, 6, '0', STR_PAD_LEFT);
    }

    private static function base32Encode(string $data): string
    {
        $binary = '';
        foreach (str_split($data) as $char) {
            $binary .= str_pad(decbin(ord($char)), 8, '0', STR_PAD_LEFT);
        }

        $encoded = '';
        foreach (str_split($binary, 5) as $chunk) {
            if (strlen($chunk) < 5) {
                $chunk = str_pad($chunk, 5, '0', STR_PAD_RIGHT);
            }
            $encoded .= self::BASE32_ALPHABET[bindec($chunk)];
        }

        return $encoded;
    }

    private static function base32Decode(string $base32): string
    {
        $clean = strtoupper(preg_replace('/[^A-Z2-7]/', '', $base32));
        if ($clean === '') {
            return '';
        }

        $binary = '';
        foreach (str_split($clean) as $char) {
            $pos = strpos(self::BASE32_ALPHABET, $char);
            if ($pos === false) {
                return '';
            }
            $binary .= str_pad(decbin($pos), 5, '0', STR_PAD_LEFT);
        }

        $decoded = '';
        foreach (str_split($binary, 8) as $byte) {
            if (strlen($byte) === 8) {
                $decoded .= chr(bindec($byte));
            }
        }

        return $decoded;
    }
}
