<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DDDD\Blog\Models\Pages;
use DDDD\Url\Models\UrlModel;
use DDDD\Blog\Models\BlogPost;
use DDDD\Blog\Models\BlogCategory;

class HomeController extends Controller
{
    //
    public function index(Request $req)
    {
        $ourToursPage = Pages::where('url_key','our-tours')->first();
        $missionPage = Pages::where('url_key','mission')->first();
        $impactsPage = Pages::where('url_key','impacts')->first();
        $blogPosts = BlogCategory::with('posts')->where('url','show-home')->first();
        $tours = TourModel::get();
        // echo '<pre>';
        // var_dump($blogPosts['posts']);
        // echo '</pre>';
        //$blogPosts = $blogCategory->posts()->get();
        return view('pages.home')->with(compact('missionPage','ourToursPage','impactsPage','blogPosts','tours'));
    }
    public function showAbout(Request $req)
    {
        $page = Pages::where('url_key','impacts')->first();
        return view('pages.about-us.show')->with(compact('page'));
    }
    public function showContact()
    {
        $page = Pages::where('url_key','contact')->first();
        return view('pages.contact.show')->with(compact('page'));
    }
    public function showFabio()
    {
        $page = Pages::where('url_key','fabio')->first();
        return view('pages.fabio.show')->with(compact('page'));
    }
    public function changeLanguage($language)
    {
        \Session::put('website_language', $language);

        return redirect()->back();
    }
}
