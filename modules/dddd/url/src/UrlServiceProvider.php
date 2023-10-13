<?php

namespace DDDD\Url;

use Illuminate\Support\ServiceProvider;

class UrlServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(Url $extension)
    {
        if (! Url::boot()) {
            return ;
        }

        if ($this->app->runningInConsole()) {
            $this->registerMigrations();
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'url');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/dddd/url')],
                'url'
            );
        }

        $this->app->booted(function () {
            Url::routes(__DIR__.'/../routes/web.php');
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
            __DIR__ . '/../database/migrations/2023_09_25_000003_create_url_manage_table.php',
            __DIR__ . '/../database/migrations/2023_09_25_000004_add_meta_seo_to_url_table.php',
            __DIR__ . '/../database/migrations/2023_10_13_000004_add_col_url__manage_table.php',

        ]);
    }
}
