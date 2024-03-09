<?php

namespace Services\Telesing;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class TelesignServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(TelesignService::class, function ($app) {
            return new TelesignService(
                baseUrl     : config('telesign.base_url'),
                customerId  : config('telesign.customer_id'),
                apiKey      : config('telesign.api_key'),
                client      : new Client(['base_uri' => config('telesign.base_url')])
            );
        });

        $this->app->bind(
            \Services\Telesing\TelesignContract::class,
            \Services\Telesing\TelesignService::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
