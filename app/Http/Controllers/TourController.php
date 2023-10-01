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
        $tours = TourModel::get();
        return view('pages.tours.list_tours');
    }
    public function showDetails($url)
    {
        $tour = TourModel::where('url',$url)->first();
        return view('pages.tours.details')->with(compact('tour'));

    }
    public function showPageTourDetails($url){
        $tour = Pages::where('url_key',$url)->first();
        return view('pages.tours.page_tour_details')->with(compact('tour'));
    }
}
