<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // ✅ IMPORTANTE: Agregar esta línea

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
        // Forzar HTTP en desarrollo (para Wokwi)
        if (env('APP_ENV') === 'local') {
            URL::forceScheme('http');
        }
    }
}