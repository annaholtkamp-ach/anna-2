<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        // Register component prefix
        Blade::componentNamespace('App\\View\\Components\\Flux', 'flux');

        // Add flux directives
        Blade::directive('fluxScripts', function () {
            return '<?php /* Flux Scripts */ ?>';
        });

        Blade::directive('fluxAppearance', function () {
            return '<?php /* Flux Appearance */ ?>';
        });
    }
}
