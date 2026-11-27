<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

/**
 * Handles file uploads cleanly across Supabase Storage (Vercel/cloud) and local Laravel disks.
 */
class SupabaseStorageService
{
    private string $baseUrl;
    private string $serviceKey;
    private string $bucket;

    public function __construct()
    {
        $this->baseUrl = rtrim((string) config('services.supabase.url', ''), '/');
        $this->serviceKey = trim((string) config('services.supabase.service_key', ''));
        $this->bucket = trim((string) config('services.supabase.bucket', 'gat-uploads'));
    }

    public function isEnabled(): bool
    {
        return $this->baseUrl !== '' && $this->serviceKey !== '' && $this->bucket !== '';
    }

    public function storeUploadedFile(
        UploadedFile $file,
        string $folder,
        string $fallbackDisk = 'public',
        ?string $customFilename = null,
        bool $isPrivate = false
    ): string {
        $cleanFolder = trim($folder, '/');

        if (! $this->isEnabled()) {
            return $customFilename
                ? (string) $file->storeAs($cleanFolder, $customFilename, $fallbackDisk)
                : (string) $file->store($cleanFolder, $fallbackDisk);
        }

        $ext = strtolower($file->getClientOriginalExtension() ?: $file->extension() ?: 'bin');
        $filename = $customFilename ?: (Str::random(32) . '.' . $ext);
        $objectPath = ($cleanFolder !== '' ? $cleanFolder . '/' : '') . $filename;
        $mimeType = $file->getMimeType() ?: 'application/octet-stream';
        $bytes = @file_get_contents($file->getRealPath());

        if ($bytes !== false) {
            try {
                $response = Http::timeout(20)
                    ->withToken($this->serviceKey)
                    ->withHeaders([
                        'apikey' => $this->serviceKey,
                        'x-upsert' => 'true',
                    ])
                    ->withBody($bytes, $mimeType)
                    ->post("{$this->baseUrl}/storage/v1/object/{$this->bucket}/{$objectPath}");

                if ($response->successful()) {
                    return $isPrivate
                        ? 'supabase://' . $objectPath
                        : "{$this->baseUrl}/storage/v1/object/public/{$this->bucket}/{$objectPath}";
                }

                Log::warning('Supabase Storage upload failed; falling back to local disk.', [
                    'status' => $response->status(),
                    'body' => Str::limit($response->body(), 300),
                    'path' => $objectPath,
                ]);
            } catch (\Throwable $e) {
                Log::warning('Supabase Storage upload exception; falling back to local disk.', [
                    'error' => $e->getMessage(),
                    'path' => $objectPath,
                ]);
            }
        }

        return $customFilename
            ? (string) $file->storeAs($cleanFolder, $customFilename, $fallbackDisk)
            : (string) $file->store($cleanFolder, $fallbackDisk);
    }

    public function deleteStoredPath(?string $storedPath, string $fallbackDisk = 'public'): void
    {
        if (empty($storedPath)) {
            return;
        }

        $objectPath = $this->extractSupabaseObjectPath($storedPath);
        if ($objectPath !== null && $this->isEnabled()) {
            try {
                Http::timeout(10)
                    ->withToken($this->serviceKey)
                    ->withHeaders(['apikey' => $this->serviceKey])
                    ->delete("{$this->baseUrl}/storage/v1/object/{$this->bucket}", [
                        'prefixes' => [$objectPath],
                    ]);
            } catch (\Throwable $e) {
                Log::warning('Supabase Storage delete failed', ['path' => $objectPath, 'error' => $e->getMessage()]);
            }

            return;
        }

        if (! str_starts_with($storedPath, 'http://') && ! str_starts_with($storedPath, 'https://')) {
            if (Storage::disk($fallbackDisk)->exists($storedPath)) {
                Storage::disk($fallbackDisk)->delete($storedPath);
            }
        }
    }

    public function exists(?string $storedPath, string $fallbackDisk = 'local'): bool
    {
        if (empty($storedPath)) {
            return false;
        }

        if ($this->extractSupabaseObjectPath($storedPath) !== null) {
            return $this->getBytes($storedPath, $fallbackDisk) !== null;
        }

        return Storage::disk($fallbackDisk)->exists($storedPath);
    }

    public function getBytes(?string $storedPath, string $fallbackDisk = 'local'): ?string
    {
        if (empty($storedPath)) {
            return null;
        }

        $objectPath = $this->extractSupabaseObjectPath($storedPath);
        if ($objectPath !== null && $this->isEnabled()) {
            try {
                $response = Http::timeout(15)
                    ->withToken($this->serviceKey)
                    ->withHeaders(['apikey' => $this->serviceKey])
                    ->get("{$this->baseUrl}/storage/v1/object/{$this->bucket}/{$objectPath}");

                if ($response->successful()) {
                    return $response->body();
                }
            } catch (\Throwable $e) {
                Log::warning('Supabase Storage fetch failed', ['path' => $objectPath, 'error' => $e->getMessage()]);
            }

            return null;
        }

        if (Storage::disk($fallbackDisk)->exists($storedPath)) {
            return (string) Storage::disk($fallbackDisk)->get($storedPath);
        }

        return null;
    }

    public function downloadResponse(string $storedPath, string $downloadFilename, string $fallbackDisk = 'local'): Response
    {
        if ($this->extractSupabaseObjectPath($storedPath) !== null) {
            $bytes = $this->getBytes($storedPath, $fallbackDisk);
            if ($bytes === null) {
                abort(404, 'Dokumen tidak ditemukan di penyimpanan cloud.');
            }

            $ext = strtolower(pathinfo($downloadFilename, PATHINFO_EXTENSION));
            $mime = match ($ext) {
                'pdf' => 'application/pdf',
                'jpg', 'jpeg' => 'image/jpeg',
                'png' => 'image/png',
                'webp' => 'image/webp',
                default => 'application/octet-stream',
            };

            return response($bytes, 200, [
                'Content-Type' => $mime,
                'Content-Disposition' => 'inline; filename="' . basename($downloadFilename) . '"',
            ]);
        }

        if (! Storage::disk($fallbackDisk)->exists($storedPath)) {
            abort(404, 'Lampiran dokumen tidak ditemukan.');
        }

        return Storage::disk($fallbackDisk)->response($storedPath, basename($downloadFilename));
    }

    private function extractSupabaseObjectPath(string $storedPath): ?string
    {
        if (str_starts_with($storedPath, 'supabase://')) {
            return ltrim(substr($storedPath, strlen('supabase://')), '/');
        }

        if ($this->baseUrl !== '' && $this->bucket !== '') {
            $publicPrefix = "{$this->baseUrl}/storage/v1/object/public/{$this->bucket}/";
            if (str_starts_with($storedPath, $publicPrefix)) {
                return ltrim(substr($storedPath, strlen($publicPrefix)), '/');
            }
        }

        return null;
    }
}
