<?php


namespace Claassenmarius\LaravelSkynet;

use Illuminate\Support\ServiceProvider;

class SkynetServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Skynet::class, function ($app) {
            return new Skynet(
                config('skynet.account_username'),
                config('skynet.account_password'),
                config('skynet.system_id'),
                config('skynet.account_number')
            );
        });

        $this->app->bind('skynet', function ($app) {
            return new Skynet(
                config('skynet.account_username'),
                config('skynet.account_password'),
                config('skynet.system_id'),
                config('skynet.account_number')
            );
        });

        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'skynetpackage');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('skynet.php'),
            ], 'config');
        }
    }
}
