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
            $client = new Client([
                'base_uri' => 'https://api.themoviedb.org/3/',
                'timeout'  => 5.0,
            ]);

            return new TMDbService($client);
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
