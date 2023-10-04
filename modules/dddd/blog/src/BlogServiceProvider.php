<?php

namespace DDDD\Blog;

use Illuminate\Support\ServiceProvider;
use DDDD\Blog\Observers\BlogPostObserver;
use DDDD\Blog\Observers\BlogCategoryObserver;
use DDDD\Blog\Observers\PagesObserver;
use DDDD\Blog\Observers\CompanionObserver;
use DDDD\Blog\Observers\VideoObserver;
use DDDD\Blog\Observers\UploadFileMediaObserver;

use DDDD\Blog\Models\BlogCategory;
use DDDD\Blog\Models\Pages;
use DDDD\Blog\Models\BlogPost;
use DDDD\Blog\Models\Companion;
use DDDD\Blog\Models\Video;
use DDDD\Blog\Models\UploadFileMedia;

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
            Video::observe(VideoObserver::class);
            Companion::observe(CompanionObserver::class);
            UploadFileMedia::observe(UploadFileMediaObserver::class);

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
