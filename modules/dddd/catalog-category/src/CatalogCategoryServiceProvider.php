<?php

namespace DDDD\CatalogCategory;

use DDDD\CatalogCategory\Observers\CatalogCategoryObserver;
use Illuminate\Support\ServiceProvider;

class CatalogCategoryServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(CatalogCategory $extension)
    {
        if (!CatalogCategory::boot()) {
            return;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'catalog-category');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/DDDD/catalog-category')],
                'catalog-category'
            );
        }

        $this->app->booted(function () {
            CatalogCategory::routes(__DIR__ . '/../routes/web.php');
          //  $this->registerMigrations();
        });
        Models\CatalogCategory::observe(CatalogCategoryObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function registerMigrations()
    {
        $this->loadMigrationsFrom( __DIR__ . '/../database/migrations');
    }
}
