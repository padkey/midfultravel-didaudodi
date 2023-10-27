<?php

namespace DDDD\EAVAttribute;

use DTV\EAVAttribute\Database\Seeders\DatabaseSeeder;
use DTV\EAVAttribute\Observers\EavAttributeGroupObserver;
use DTV\EAVAttribute\Observers\EavAttributeSetObserver;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class EAVAttributeServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(EAVAttribute $extension)
    {
        if (!EAVAttribute::boot()) {
            return;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'eav-attribute');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/dtv/eav-attribute')],
                'eav-attribute'
            );
        }

        $this->app->booted(function () {
            EAVAttribute::routes(__DIR__ . '/../routes/web.php');
            $this->registerMigrations();
            $this->registerDbSeed();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function registerMigrations(): void
    {
        $this->loadMigrationsFrom(dirname(__DIR__) . '/database/migrations');
    }

    /**
     * Register the package DbSeed.
     *
     * @return void
     */
    public function registerDbSeed(): void
    {
        if ($this->app->runningInConsole()) {
            if ($this->isConsoleCommandDbSeed()) {
                Artisan::call('db:seed', ['--class' => DatabaseSeeder::class]);
            }
        }
    }

    /**
     * Get a value that indicates whether the current command in console
     * contains a string in the specified $fields.
     *
     *
     * @return bool
     */
    public function isConsoleCommandDbSeed(): bool
    {
        $args = Request::server('argv', null);
        if (is_array($args)) {
            $command = implode(' ', $args);
            if (str_contains($command, 'db:seed')) {
                return true;
            }
        }
        return false;
    }
}
