<?php

namespace App\Providers;

use App\Models\General;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton("helpers", function () {
            return require app_path("Helpers\helpers.php");
        });
        $loader = AliasLoader::getInstance();

        // Add your aliases
        $loader->alias('PDF', TCPDF::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['ar', 'en']); // also accepts a closure
        });
    }
}
