<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $forwardedProto = strtolower((string) request()->header('X-Forwarded-Proto', ''));
        $cfVisitor = strtolower((string) request()->header('CF-Visitor', ''));

        if (
            app()->environment('production')
            || isset($_SERVER['VERCEL'])
            || getenv('VERCEL')
            || $forwardedProto === 'https'
            || str_contains($cfVisitor, '"https"')
        ) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
