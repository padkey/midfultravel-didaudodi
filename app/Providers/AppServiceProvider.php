<?php

namespace App\Providers;
use DDDD\Banner\Models\Banner;
use DDDD\Blog\Models\Pages;
use DDDD\Url\Models\UrlModel;
use DDDD\Blog\Models\BlogPost;
use DDDD\Blog\Models\BlogCategory;
use DDDD\Tour\Models\Partnership;

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
        /*$locale_code =   \Session::get('website_language', config('app.locale'));
        echo $locale_code;*/
        //
        // $ourToursPage = Pages::where('url_key','our-tours')->first();
        // $missionPage = Pages::where('url_key','mission')->first();
        // $impactsPage = Pages::where('url_key','impacts')->first();
        // $tours = TourModel::get();
        // $blogPosts = BlogCategory::with('posts')->where('url','show-home')->first();
        // $categoryPost = BlogCategory::where('url','!=','show-home')->get();
        /*$categoryPost = BlogCategory::where('url','!=','show-home-center')->where('locale_code',$locale_code)->where('url','!=','show-home-right')->where('url','!=','show-home-left')->get();
        $logoWhite = Banner::with('items')->where('uuid','logo_white')->first();
        $logoBlack = Banner::with('items')->where('uuid','logo_black')->first();

        View::share(compact('categoryPost','logoWhite','logoBlack'));*/
    }
}
