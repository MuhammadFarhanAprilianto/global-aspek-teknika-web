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

        // Bootstrap schema & initial catalog automatically when Vercel connects to a brand-new Cloud DB (Supabase/MySQL)
        if (
            (isset($_SERVER['VERCEL']) || getenv('VERCEL') === '1')
            && ! app()->runningInConsole()
            && ! app()->runningUnitTests()
            && config('database.default') !== 'sqlite'
        ) {
            $hostKey = md5((string) config('database.connections.' . config('database.default') . '.host', 'cloud'));
            $marker = '/tmp/.gat_db_booted_' . $hostKey;
            if (! is_file($marker)) {
                try {
                    if (! \Illuminate\Support\Facades\Schema::hasTable('users')) {
                        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
                        \Illuminate\Support\Facades\Artisan::call('db:seed', [
                            '--class' => \Database\Seeders\CatalogBootstrapSeeder::class,
                            '--force' => true,
                        ]);
                    }
                    @file_put_contents($marker, (string) time());
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::warning('Cloud DB auto-bootstrap skipped: ' . $e->getMessage());
                }
            }
        }
    }
}
