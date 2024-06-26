<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DDDD\Blog\Models\Block;
use DDDD\Blog\Models\Companion;
use Illuminate\Http\Request;
use DDDD\Tour\Models\TourModel;
use DDDD\Blog\Models\Pages;

class TourController extends Controller
{
    //
    public function showList( Request $req)
    {
        $locale_code =   config('app.locale');
        $tours = TourModel::where('locale_code',$locale_code)->where('is_active',1)->get();
        if (count($tours) > 0) {
            // ----------- SEO -----------\\
            $metaDes = 'Danh sách tour du lịch chánh niệm';
            $metaKeywords = 'anh sách tour du lịch chánh niệm';
            $metaTitle = 'Danh sách tour du lịch chánh niệm';
            $urlCanonical = $req->url();
            // ----------- End Seo -----------\\
            return view('pages.tours.list_tours')->with(compact('tours','metaDes','metaTitle','metaKeywords','urlCanonical'));
        }
       abort(404);
    }
    public function showDetails($url, Request $req)
    {
        $locale_code =   config('app.locale');
        /*$currentDate = Carbon::now();*/

        $companions = Companion::where('locale_code',$locale_code)->take(4)->get();
        $blackgroundCompanion = Block::where('locale_code',$locale_code)->where('code','blackground_companion')->first();
        $tour = TourModel::with(['tourSchedule' => function ($q){
            $q->orderBy('order','ASC');
            }])->where('locale_code',$locale_code)
            ->where('url',$url)->where('is_active',1)->first();



        if($tour) {
            // ----------- SEO -----------\\
            $metaDes = $tour->meta_description;
            $metaKeywords =$tour->meta_keywords;
            $metaTitle = $tour->meta_title;
            $urlCanonical = $req->url();
            // ----------- End Seo -----------\\

            return view('pages.tours.details2')->with(compact('tour','companions',
                'blackgroundCompanion','metaDes','metaTitle','metaKeywords','urlCanonical'));
        }
        abort(404);
        /* $toursTookPlace = TourModel::where('locale_code',$locale_code)
             ->where('url',$url)->where('is_active',1)->where('date_end','>',$currentDate)->get();*/
/*
        $geojson = array('type' => 'FeatureCollection', 'features' => array());
        if(!is_null($tour)) {
            if(count($tour->tourSchedule) > 0){
                foreach ($tour->tourSchedule as $schedule) {
                    $position = $schedule->position;
                    $position = explode(',',$position);
                    // google map dịch ngược
                    $lng = (double)$position[1];
                    $lat = (double)$position[0];

                    $marker = array(
                        'type' => 'Feature',
                        'features' => array(
                            'type' => 'Feature',
                            "geometry" => array(
                                'type' => 'Polygon',
                                'coordinates' => array(
                                    $lng,
                                    $lat
                                )
                            )
                        )
                    );
                    array_push($geojson['features'], $marker);
                }
            }
        } else {
            return redirect('/');
        }
        $geojson =  json_encode($geojson);*/


    }
    public function showDetails2()  //$url
    {
        //temp
       // $url = 'mindful-travel-to-europe';
        $locale_code =   config('app.locale');
        $currentDate = Carbon::now();

        $companions = Companion::where('locale_code',$locale_code)->take(4)->get();
        $blackgroundCompanion = Block::where('locale_code',$locale_code)->where('code','blackground_companion')->first();
        $tour = TourModel::with(['tourSchedule' => function ($q){
            $q->orderBy('order','ASC');
        }])->where('locale_code',$locale_code)
            ->where('url',$url)->where('is_active',1)->first();

        $toursTookPlace = TourModel::where('locale_code',$locale_code)
            ->where('url',$url)->where('is_active',1)->where('date_end','>',$currentDate)->get();

        $geojson = array('type' => 'FeatureCollection', 'features' => array());
        if(!is_null($tour)) {
            if(count($tour->tourSchedule) > 0){
                foreach ($tour->tourSchedule as $schedule) {
                    $position = $schedule->position;
                    $position = explode(',',$position);
                    // google map dịch ngược
                    $lng = (double)$position[1];
                    $lat = (double)$position[0];

                    $marker = array(
                        'type' => 'Feature',
                        'features' => array(
                            'type' => 'Feature',
                            "geometry" => array(
                                'type' => 'Polygon',
                                'coordinates' => array(
                                    $lng,
                                    $lat
                                )
                            )
                        )
                    );
                    array_push($geojson['features'], $marker);
                }
            }
        } else {
            return redirect('/');
        }

        $geojson =  json_encode($geojson);
        return view('pages.tours.details2')->with(compact('tour','companions','blackgroundCompanion','geojson','toursTookPlace'));

    }
    /*public function showPageTourDetails($url,Request $req){
        // ----------- SEO -----------\\
        $metaDes = "Tour du lịch chánh niệm";
        $metaKeywords = "Tour du lịch chánh niệm";
        $metaTitle = "Didaudodi mindfultravel";
        $urlCanonical = $req->url();
        // ----------- End Seo -----------\\

        $locale_code =   config('app.locale');
        $tour = Pages::where('locale_code',$locale_code)->where('url_key',$url)->where('is_active',1)->first();
        //return view('pages.tours.page_tour_details')->with(compact('tour'));
        return view('pages.tours.details2')->with(compact('tour','metaDes','metaTitle','metaKeywords','urlCanonical'));
    }*/
    public function showDetailsChangeLanguage($url,$locale) {
        \Session::put('website_language', $locale);

        return redirect('/tours/'. $url);
    }
}
