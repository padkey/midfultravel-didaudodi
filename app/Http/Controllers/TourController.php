<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DDDD\Tour\Models\TourModel;
use DDDD\Blog\Models\Pages;

class TourController extends Controller
{
    //
    public function showList()
    {
        $locale_code =   config('app.locale');
        $tours = TourModel::where('locale_code',$locale_code)->get();
        return view('pages.tours.list_tours')->with(compact('tours'));
    }
    public function showDetails($url)
    {
        $locale_code =   config('app.locale');
        $tour = TourModel::where('locale_code',$locale_code)->where('url',$url)->first();
        return view('pages.tours.details')->with(compact('tour'));

    }
    public function showPageTourDetails($url){
        $locale_code =   config('app.locale');
        $tour = Pages::where('locale_code',$locale_code)->where('url_key',$url)->first();
        return view('pages.tours.page_tour_details')->with(compact('tour'));
    }
}
