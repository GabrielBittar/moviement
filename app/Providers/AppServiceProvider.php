<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TMDBService;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TMDBService::class, function ($app) {
            $client = new Client([
                'base_uri' => 'https://api.themoviedb.org/3/',
                'timeout'  => 5.0,
            ]);

            return new TMDBService($client);
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
