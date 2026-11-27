<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*');
        $middleware->web(append: [
            \App\Http\Middleware\TrackVisitor::class,
        ]);
        $middleware->alias([
            'is_admin' => \App\Http\Middleware\IsAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $handleCsrfExpired = function (\Illuminate\Http\Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Sesi halaman kadaluarsa. Silakan muat ulang halaman.',
                    'csrf_token' => csrf_token(),
                ], 419);
            }

            if ($request->is('login') || $request->routeIs('login', 'login.post')) {
                return redirect()->route('login')
                    ->with('status', 'Sesi halaman login telah disegarkan. Silakan klik Masuk kembali.');
            }

            return back()
                ->withInput($request->except(['password', 'password_confirmation', '_token']))
                ->with('status', 'Sesi halaman telah disegarkan otomatis. Silakan kirim ulang.');
        };

        $exceptions->render(function (\Illuminate\Session\TokenMismatchException $e, \Illuminate\Http\Request $request) use ($handleCsrfExpired) {
            return $handleCsrfExpired($request);
        });

        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\HttpExceptionInterface $e, \Illuminate\Http\Request $request) use ($handleCsrfExpired) {
            if ($e->getStatusCode() === 419) {
                return $handleCsrfExpired($request);
            }
        });
    })->create();

if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']) || getenv('VERCEL') || getenv('APP_STORAGE')) {
    $storagePath = getenv('APP_STORAGE') ?: '/tmp/storage';
    $app->useStoragePath($storagePath);
}

return $app;
