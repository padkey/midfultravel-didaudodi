<?php

namespace DDDD\TourEnquire;

use DDDD\TourEnquire\Services\ISubmitProductTourEnquireService;
use DDDD\TourEnquire\Services\ISubmitTourEnquireService;
use DDDD\TourEnquire\Services\SubmitProductTourEnquireServiceService;
use DDDD\TourEnquire\Services\SubmitTourEnquireServiceService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class TourEnquireServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(TourEnquire $extension)
    {
        if (! TourEnquire::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'TourEnquire');
        }

        if ($this->app->runningInConsole()) {
            $this->registerMigrations();
        }

        $this->app->booted(function () {
            TourEnquire::routes(__DIR__.'/../routes/web.php');
            $this->loadRoutesFrom(__DIR__ . '/../routes/app.php');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function registerMigrations(): void
    {
        $this->loadMigrationsFrom([
            __DIR__ . '/../database/migrations'
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ISubmitProductTourEnquireService::class, SubmitProductTourEnquireServiceService::class);
        $this->app->bind(ISubmitTourEnquireService::class, SubmitTourEnquireServiceService::class);

    }

}
