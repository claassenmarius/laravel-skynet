<?php


namespace Claassenmarius\LaravelSkynet;

use Illuminate\Support\Facades\Route;
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

        /* Merge the config values of the package's config file to the config file inside
         / the user's laravel app when the laravel app boots
        */
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'skynet');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {

            // Allow user to publish the package's config file to their laravel app
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('skynet.php'),
            ], 'config');

            // Allow the user to publish the package's migrations to their laravel app
            if (! class_exists(\CreateQuotesTable::class)) {
                $this->publishes([
                    __DIR__.'/../database/migrations/create_quotes_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_quotes_table.php'),
                ], 'migrations');
            }
        }

        $this->registerRoutes();
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => config('skynet.prefix'),
            'middleware' => config('skynet.middleware'),
        ];
    }
}
