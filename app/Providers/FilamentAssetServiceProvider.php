<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;

class FilamentAssetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        FilamentAsset::register([
            Css::make('custom-stylesheet', __DIR__ . '/../../resources/css/custom.css'),
        ]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
