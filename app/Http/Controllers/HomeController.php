<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DDDD\Blog\Models\Pages;
use DDDD\Url\Models\UrlModel;
use DDDD\Blog\Models\BlogPost;
use DDDD\Blog\Models\BlogCategory;
use DDDD\Blog\Models\Video;
use DDDD\Blog\Models\Companion;
use DDDD\Blog\Models\Block;
use DDDD\Tour\Models\TourModel;
use DDDD\Banner\Models\Banner;

class HomeController extends Controller
{
    //
    public function index(Request $req)
    {
        $tours = TourModel::get();
        $blogPostsCenter = BlogCategory::with('posts')->where('url','show-home-center')->first();
        $blogPostsLeft = BlogCategory::with('posts')->where('url','show-home-left')->first();
        $blogPostsRight = BlogCategory::with('posts')->where('url','show-home-right')->first();
        $blockOurMission = Block::where('code','our_mission')->first();
        $blockOurTour= Block::where('code','our_tour')->first();
        $blockValue = Block::where('code','value')->first();
        $blockShortAboutUs = Block::where('code','short_about_us')->first();
        $blackgroundCompanion = Block::where('code','blackground_companion')->first();
        $TourBackground =Block::where('code','popular_tour')->first();
        $videos = Video::get();
        $companions = Companion::get();

        $sloganImage = Banner::with('items')->where('uuid','slogan_image')->first();
        $bannerHomeImage = Banner::with('items')->where('uuid','banner_home')->first();
        /*echo '<pre>';
        var_dump($sloganImage->items[0]->path_desktop);
        echo '</pre>';
        die();*/
        return view('pages.home')->with(compact('blockValue',
            'sloganImage','bannerHomeImage','blackgroundCompanion','TourBackground',
            'blockOurTour','blockOurMission','blogPostsCenter','blockShortAboutUs',
            'blogPostsLeft','blogPostsRight','tours','videos','companions'));
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
