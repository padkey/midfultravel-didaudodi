<?php

namespace DDDD\Partnership;

use Illuminate\Support\ServiceProvider;
use DDDD\Partnership\Observers\PartnershipObserver;
use DDDD\Partnership\Observers\PartnershipBranchObserver;
use DDDD\Partnership\Models\PartnershipModel;  
use DDDD\Partnership\Models\PartnershipBranch;   
class PartnershipServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(Partnership $extension)
    {
        if (! Partnership::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'partnership');
        }

        if ($this->app->runningInConsole()) {
            $this->registerMigrations();
        }


        $this->app->booted(function () {
            Partnership::routes(__DIR__.'/../routes/web.php');
            // Observer: MenuItems Model
            // BlogCategory::observe(BlogCategoryObserver::class);
            // BlogPost::observe(BlogPostObserver::class);
            // Pages::observe(PagesObserver::class);
            PartnershipModel::observe(PartnershipObserver::class);
            PartnershipBranch::observe(PartnershipBranchObserver::class);

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function registerMigrations(): void
    {
        $this->loadMigrationsFrom( __DIR__ . '/../database/migrations');
    }
}
