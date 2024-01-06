<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        //----seo để cho google biết là google biết mình miêu tả trang web như thế này
        $metaDes = "Tour du lịch chánh niệm";
        //keywords này để người dùng nhập trên google xong nó hiện trang web của mình
        $metaKeywords = "Tour du lịch chánh niệm";
        // tiêu đề
        $metaTitle = "Didaudodi mindfultravel";
        //lấy ra đường dẫn hiện tại của trang mình đang truy cập
        $urlCanonical = $req->url();
        // ----------- End Seo -----------\\



        $locale_code =   config('app.locale');
        $currentDate = Carbon::now();

        $tours = TourModel::where('locale_code',$locale_code)->where('is_active',1)->where('date_end','>',$currentDate)->get();
        $toursTookPlace = TourModel::where('locale_code',$locale_code)->where('is_active',1)->where('date_end','<',$currentDate)->get();
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
        /*$blockValue = Block::where('locale_code',$locale_code)->where('code','value')->first();*/
        //Core Value
        $valueMindfulness= Block::where('locale_code',$locale_code)->where('code','core_value_mindfulness')->first();
        $valueConnection = Block::where('locale_code',$locale_code)->where('code','core_value_connection')->first();
        $valueSustainability = Block::where('locale_code',$locale_code)->where('code','core_value_sustainability')->first();
        $valuePersonalGrowth = Block::where('locale_code',$locale_code)->where('code','core_value_personal_growth')->first();


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
        return view('pages.home')->with(compact('metaDes','metaTitle','metaKeywords','urlCanonical',
            'sloganImage','bannerHomeImage','blackgroundCompanion','TourBackground',
            'blockOurTour','blockOurMission','blogPostsCenter','blockShortAboutUs',
            'blogPostsLeft','blogPostsRight','tours','videos','companions','toursTookPlace',
            'valueMindfulness','valueConnection','valueSustainability','valuePersonalGrowth',
        ));
    }
    public function showAbout(Request $req)
    {
        $locale_code =   config('app.locale');
        $page = Pages::where('url_key','about-us')->where('locale_code',$locale_code)->first();
        // ----------- SEO -----------\\
        $metaDes = $page->meta_description;
        $metaKeywords =$page->meta_keywords;
        $metaTitle = $page->meta_title;
        $urlCanonical = $req->url();
        // ----------- End Seo -----------\\
        return view('pages.about-us.show')->with(compact('page','metaDes','metaTitle','metaKeywords','urlCanonical',));
    }
    public function showContact(Request $req)
    {
        $locale_code =   config('app.locale');
        $page = Pages::where('url_key','contact')->where('locale_code',$locale_code)->first();
        // ----------- SEO -----------\\
        $metaDes = $page->meta_description;
        $metaKeywords =$page->meta_keywords;
        $metaTitle = $page->meta_title;
        $urlCanonical = $req->url();
        // ----------- End Seo -----------\\

        return view('pages.contact.show')->with(compact('page','metaDes','metaTitle','metaKeywords','urlCanonical'));
    }
    public function showFabio(Request $req)
    {
        $locale_code =  config('app.locale');
        $page = Pages::where('url_key','fabio')->where('locale_code',$locale_code)->first();
        // ----------- SEO -----------\\
        $metaDes = $page->meta_description;
        $metaKeywords =$page->meta_keywords;
        $metaTitle = $page->meta_title;
        $urlCanonical = $req->url();
        // ----------- End Seo -----------\\

        return view('pages.fabio.show')->with(compact('page','metaDes','metaTitle','metaKeywords','urlCanonical',));
    }
    public function changeLanguage($language)
    {
        \Session::put('website_language', $language);
        return redirect()->back();
    }
    public function changeLanguageHome($language)
    {
        \Session::put('website_language', $language);
        return redirect('/');
    }
}
