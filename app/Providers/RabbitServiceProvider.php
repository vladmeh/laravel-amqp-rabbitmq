<?php

namespace App\Providers;

use App\Services\RabbitRpc;
use Illuminate\Support\ServiceProvider;

class RabbitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__ . '/../config/rabbit.php' => config_path('rabbit.php'),
        ], 'rabbit');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(RabbitRpc::class, function () {
            return new RabbitRpc(config('rabbit.connections.stream'));
        });
    }
}
