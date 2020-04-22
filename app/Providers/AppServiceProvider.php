<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->forceUrlScheme();
    }

    private function forceUrlScheme()
    {
        $scheme = app()->environment('local') ? 'http' : 'https';

        // This will override all implicit bindings within the route provider
        URL::forceScheme($scheme);
    }
}
