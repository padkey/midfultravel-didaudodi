<?php

namespace DDDD\Tour;

use Illuminate\Support\ServiceProvider;
use DDDD\Blog\Observers\BlogPostObserver;
use DDDD\Blog\Observers\BlogCategoryObserver;
use DDDD\Blog\Observers\PagesObserver;
use DDDD\Tour\Observers\TourObserver;

use DDDD\Blog\Models\BlogCategory;
use DDDD\Blog\Models\Pages;
use DDDD\Blog\Models\BlogPost;
use DDDD\Tour\Models\TourModel;
class TourServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(Tour $extension)
    {
        if (! Tour::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'tour');
        }

        if ($this->app->runningInConsole()) {
            $this->registerMigrations();
        }


        $this->app->booted(function () {
            Tour::routes(__DIR__.'/../routes/web.php');

            // Observer: MenuItems Model
            // BlogCategory::observe(BlogCategoryObserver::class);
            // BlogPost::observe(BlogPostObserver::class);
            // Pages::observe(PagesObserver::class);
            TourModel::observe(TourObserver::class);

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
