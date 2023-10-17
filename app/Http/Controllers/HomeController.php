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
        $locale_code =   config('app.locale');

        $tours = TourModel::where('locale_code',$locale_code)->where('is_active',1)->get();
        //center
        $catePostsCenter = BlogCategory::with('posts')->where('url','show-home-center')->first();
        $listPostsCenter  = $catePostsCenter->posts();
        $blogPostsCenter = $listPostsCenter->orderByDesc('id')->where('locale_code',$locale_code)->get();
        //left
        $catePostsLeft  = BlogCategory::with('posts')->where('url','show-home-left')->first();
        $listPostsLeft   = $catePostsLeft->posts();
        $blogPostsLeft = $listPostsLeft->orderByDesc('id')->where('locale_code',$locale_code)->get();
        //right
        $catePostsRight= BlogCategory::with('posts')->where('url','show-home-right')->first();
        $listPostsRight = $catePostsRight->posts();
        $blogPostsRight = $listPostsRight->orderByDesc('id')->where('locale_code',$locale_code)->get();

        //$blogPostsLeft = BlogCategory::with('posts')->where('locale_code',$locale_code)->where('url','show-home-left')->first();
        //$blogPostsRight = BlogCategory::with('posts')->where('locale_code',$locale_code)->where('url','show-home-right')->first();
        $blockOurMission = Block::where('locale_code',$locale_code)->where('code','our_mission')->first();
        $blockOurTour= Block::where('locale_code',$locale_code)->where('code','our_tour')->first();
        $blockValue = Block::where('locale_code',$locale_code)->where('code','value')->first();
        $blockShortAboutUs = Block::where('locale_code',$locale_code)->where('code','short_about_us')->first();
        $blackgroundCompanion = Block::where('locale_code',$locale_code)->where('code','blackground_companion')->first();
        $TourBackground =Block::where('locale_code',$locale_code)->where('code','popular_tour')->first();
        $videos = Video::where('locale_code',$locale_code)->get();
        $companions = Companion::where('locale_code',$locale_code)->get();

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
        $locale_code =   config('app.locale');
        $page = Pages::where('url_key','about-us')->where('locale_code',$locale_code)->first();
        return view('pages.about-us.show')->with(compact('page'));
    }
    public function showContact()
    {
        $locale_code =   config('app.locale');
        $page = Pages::where('url_key','contact')->where('locale_code',$locale_code)->first();
        return view('pages.contact.show')->with(compact('page'));
    }
    public function showFabio()
    {
        $locale_code =  config('app.locale');
        $page = Pages::where('url_key','fabio')->where('locale_code',$locale_code)->first();
        return view('pages.fabio.show')->with(compact('page'));
    }
    public function changeLanguage($language)
    {
        \Session::put('website_language', $language);

        return redirect()->back();
    }
}
