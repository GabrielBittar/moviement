<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TMDbService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TMDbService::class, function ($app) {
            return new TMDbService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
