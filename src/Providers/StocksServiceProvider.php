<?php

namespace CamilleG\Stocks\Providers;

use CamilleG\Stocks\StocksService;
use Illuminate\Support\ServiceProvider;

class StocksServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/stocks.php' => config_path('pay.php'),
        ]);
    }

    /**
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/stocks.php', 'stocks');

        $this->app->singleton('stocks', function ($app) {
            $config = $app->make('config')->get('stocks');

            return new StocksService($config);
        });
    }
}
