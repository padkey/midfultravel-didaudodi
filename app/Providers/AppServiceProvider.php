<?php

namespace App\Providers;
use DDDD\Blog\Models\Pages;
use DDDD\Url\Models\UrlModel;
use DDDD\Blog\Models\BlogPost;
use DDDD\Blog\Models\BlogCategory;
use DDDD\Tour\Models\TourModel;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $ourToursPage = Pages::where('url_key','our-tours')->first();
        $missionPage = Pages::where('url_key','mission')->first();
        $impactsPage = Pages::where('url_key','impacts')->first();
        $tours = TourModel::get();
        $blogPosts = BlogCategory::with('posts')->where('url','show-home')->first();
        $categoryPost = BlogCategory::where('url','!=','show-home')->get();

        View::share(compact('ourToursPage','missionPage','impactsPage','blogPosts','tours','categoryPost'));
    }
}
