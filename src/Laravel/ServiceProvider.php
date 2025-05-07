<?php

namespace ZerosDev\Durianpay\Laravel;

use ZerosDev\Durianpay\Client;
use ZerosDev\Durianpay\Constant;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider implements DeferrableProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function ($app) {
            $base_url = (string) config('durianpay.credentials.default.base_url');
            $api_key = (string) config('durianpay.credentials.default.api_key');
            $mode = (string) config('durianpay.credentials.default.mode');
            return new Client($base_url, $api_key, $mode);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../laravel-config.php' => config_path('durianpay.php'),
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Client::class];
    }
}
