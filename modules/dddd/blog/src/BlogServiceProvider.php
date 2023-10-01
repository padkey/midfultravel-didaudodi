<?php

namespace DDDD\Blog;

use Illuminate\Support\ServiceProvider;
use DDDD\Blog\Observers\BlogPostObserver;
use DDDD\Blog\Observers\BlogCategoryObserver;
use DDDD\Blog\Observers\PagesObserver;
use DDDD\Blog\Models\BlogCategory;
use DDDD\Blog\Models\Pages;
use DDDD\Blog\Models\BlogPost;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(Blog $extension)
    {
        if (! Blog::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'blog');
        }

        if ($this->app->runningInConsole()) {
            $this->registerMigrations();
        }


        $this->app->booted(function () {
            Blog::routes(__DIR__.'/../routes/web.php');

            // Observer: MenuItems Model
            BlogCategory::observe(BlogCategoryObserver::class);
            BlogPost::observe(BlogPostObserver::class);
            Pages::observe(PagesObserver::class);
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
