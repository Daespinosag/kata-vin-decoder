<?php

namespace Services\VinDecoder;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class VinDecoderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(VinDecoderService::class, function ($app) {
            return new VinDecoderService(
                baseUrl     : config('vindecoder.base_url'),
                apiKey      : config('vindecoder.api_key'),
                client      : new Client(['base_uri' => config('vindecoder.base_url')])
            );
        });

        $this->app->bind(
            \Services\VinDecoder\VinDecoderContractor::class,
            \Services\VinDecoder\VinDecoderService::class
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
