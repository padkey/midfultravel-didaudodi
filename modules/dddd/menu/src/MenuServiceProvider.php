<?php

namespace DDDD\Menu;

use DDDD\Menu\Models\MenuItems;
use DDDD\Menu\Observers\MenuItemObserver;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(Menu $extension)
    {
        if (!Menu::boot()) {
            return;
        }

        if ($this->app->runningInConsole()) {
            $this->registerMigrations();
        }

        $this->app->booted(function () {
            Menu::routes(__DIR__ . '/../routes/web.php');
            // Phan nay, comment lai => muon bat thi chay "sail artisan admin:import banner"
             //Menu::import();

            // Observer: MenuItems Model
            MenuItems::observe(MenuItemObserver::class);
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
}
