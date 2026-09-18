<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Ensure serverless storage directories exist in writable /tmp directory
$storageDirs = [
    '/tmp/storage',
    '/tmp/storage/app',
    '/tmp/storage/app/public',
    '/tmp/storage/framework',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
    '/tmp/bootstrap',
    '/tmp/bootstrap/cache'
];

foreach ($storageDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Ensure SQLite database exists in /tmp if local SQLite is used
if (!file_exists('/tmp/database.sqlite')) {
    @touch('/tmp/database.sqlite');
}

// Set critical environment variables for serverless runtime
putenv('VERCEL=1');
putenv('APP_DEBUG=true');
$_ENV['APP_DEBUG'] = 'true';
$_SERVER['APP_DEBUG'] = 'true';
putenv('APP_STORAGE=/tmp/storage');
putenv('APP_CONFIG_CACHE=/tmp/bootstrap/cache/config.php');
putenv('APP_EVENTS_CACHE=/tmp/bootstrap/cache/events.php');
putenv('APP_PACKAGES_CACHE=/tmp/bootstrap/cache/packages.php');
putenv('APP_ROUTES_CACHE=/tmp/bootstrap/cache/routes.php');
putenv('APP_SERVICES_CACHE=/tmp/bootstrap/cache/services.php');
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');
// Sanitize environment variables to prevent empty string driver errors
$driverDefaults = [
    'SESSION_DRIVER' => 'cookie',
    'CACHE_STORE' => 'array',
    'CACHE_DRIVER' => 'array',
    'QUEUE_CONNECTION' => 'sync',
    'LOG_CHANNEL' => 'stderr',
    'LOG_STACK' => 'single',
    'LOG_DEPRECATIONS_CHANNEL' => 'null',
    'FILESYSTEM_DISK' => 'local',
    'BROADCAST_CONNECTION' => 'log',
    'APP_MAINTENANCE_DRIVER' => 'file',
];

foreach ($driverDefaults as $key => $default) {
    $val = getenv($key);
    if ($val === false || trim((string)$val) === '' || strtolower((string)$val) === 'null') {
        putenv("{$key}={$default}");
        $_ENV[$key] = $default;
        $_SERVER[$key] = $default;
    }
}

// If DB_HOST is 127.0.0.1 (local MySQL) or empty, fallback to SQLite to prevent connection refused errors
$dbHost = getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? $_SERVER['DB_HOST'] ?? '');
if ($dbHost === '127.0.0.1' || $dbHost === 'localhost' || empty($dbHost)) {
    putenv('DB_CONNECTION=sqlite');
    putenv('DB_DATABASE=/tmp/database.sqlite');
    $_ENV['DB_CONNECTION'] = 'sqlite';
    $_ENV['DB_DATABASE'] = '/tmp/database.sqlite';
    $_SERVER['DB_CONNECTION'] = 'sqlite';
    $_SERVER['DB_DATABASE'] = '/tmp/database.sqlite';
}

// Fallback APP_KEY if not explicitly provided
if (empty($_ENV['APP_KEY']) && empty($_SERVER['APP_KEY']) && !getenv('APP_KEY')) {
    $fallbackKey = 'base64:xlyOaE4f8tKH9+30kajfb9mrGivyFNUouVKaslw0Jio=';
    putenv("APP_KEY={$fallbackKey}");
    $_ENV['APP_KEY'] = $fallbackKey;
    $_SERVER['APP_KEY'] = $fallbackKey;
}

// Serve static files from public/ or storage/app/public/ if requested
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$parsedPath = parse_url($requestUri, PHP_URL_PATH);
$uriPath = urldecode($parsedPath ?: '/');

if ($uriPath !== '/') {
    $mimeTypes = [
        'css'   => 'text/css',
        'js'    => 'application/javascript',
        'png'   => 'image/png',
        'jpg'   => 'image/jpeg',
        'jpeg'  => 'image/jpeg',
        'webp'  => 'image/webp',
        'avif'  => 'image/avif',
        'gif'   => 'image/gif',
        'svg'   => 'image/svg+xml',
        'ico'   => 'image/x-icon',
        'mp4'   => 'video/mp4',
        'webm'  => 'video/webm',
        'json'  => 'application/json',
        'woff'  => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf'   => 'font/ttf',
    ];

    $publicFile = __DIR__ . '/../public' . $uriPath;
    $storageFile = (str_starts_with($uriPath, '/storage/'))
        ? __DIR__ . '/../storage/app/public/' . substr($uriPath, strlen('/storage/'))
        : null;

    $targetFile = (file_exists($publicFile) && !is_dir($publicFile))
        ? $publicFile
        : (($storageFile && file_exists($storageFile) && !is_dir($storageFile)) ? $storageFile : null);

    if ($targetFile) {
        $ext = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $mime = $mimeTypes[$ext] ?? 'application/octet-stream';
        while (ob_get_level()) {
            @ob_end_clean();
        }

        $size = filesize($targetFile);
        $start = 0;
        $end = $size - 1;

        header('Accept-Ranges: bytes');

        if (isset($_SERVER['HTTP_RANGE'])) {
            $range = $_SERVER['HTTP_RANGE'];
            if (preg_match('/bytes=\h*(\d+)-(\d*)[\D.*]?/i', $range, $matches)) {
                $start = intval($matches[1]);
                if (!empty($matches[2])) {
                    $end = intval($matches[2]);
                }
            }
            $length = $end - $start + 1;
            http_response_code(206);
            header("Content-Range: bytes {$start}-{$end}/{$size}");
            header('Content-Type: ' . $mime);
            header("Content-Length: {$length}");
            header('Cache-Control: public, max-age=31536000');

            $fp = fopen($targetFile, 'rb');
            if ($fp) {
                fseek($fp, $start);
                $buffer = 1024 * 64;
                while (!feof($fp) && ($pos = ftell($fp)) <= $end) {
                    if ($pos + $buffer > $end) {
                        $buffer = $end - $pos + 1;
                    }
                    echo fread($fp, $buffer);
                    flush();
                }
                fclose($fp);
            }
            exit;
        }

        if (isset($_SERVER['REQUEST_METHOD']) && strtoupper($_SERVER['REQUEST_METHOD']) === 'HEAD') {
            header('Content-Type: ' . $mime);
            header('Content-Length: ' . $size);
            header('Cache-Control: public, max-age=31536000, immutable');
            exit;
        }

        header('Content-Type: ' . $mime);
        header('Content-Length: ' . $size);
        header('Cache-Control: public, max-age=31536000, immutable');
        $fp = fopen($targetFile, 'rb');
        if ($fp) {
            $buffer = 1024 * 64;
            while (!feof($fp)) {
                echo fread($fp, $buffer);
                flush();
            }
            fclose($fp);
        } else {
            readfile($targetFile);
        }
        exit;
    }
}

try {
    // Forward Vercel requests to public/index.php
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    http_response_code(500);
    echo "<h1>Application Error</h1>";
    echo "<p><strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . ":" . $e->getLine() . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
