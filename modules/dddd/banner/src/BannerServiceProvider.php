<?php

namespace DTV\Banner;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class BannerServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        if (!Banner::boot()) {
            return;
        }

        if ($this->app->runningInConsole()) {
            //$this->registerMigrations();
        }

        $this->app->booted(function () {
            // Route
            Banner::routes(__DIR__ . '/../routes/web.php');
            $this->registerAPIRoutes();

            // Menu + Permission Admin config
            // Phan nay, comment lai => muon bat thi chay "sail artisan admin:import banner"
            // Banner::import();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function registerMigrations(): void
    {
        $this->loadMigrationsFrom( dirname(__DIR__) . '/database/migrations');
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerAPIRoutes(): void
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        });
    }

    /**
     * Get route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration(): array
    {
        return [
            'middleware' => ['api'],
            'prefix' => 'api'
        ];
    }
}
