<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\BlogController;
use DDDD\Url\Models\UrlModel;
use DDDD\Blog\Models\Pages;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::group(['middleware' => 'locale'], function() {
//     Route::get('change-language/{language}', [HomeController::class,'changeLanguage'])->name('user.change-language');

//     Route::get('/', [HomeController::class,'index']);
//     Route::get('/about-us', [HomeController::class,'showAbout']);
//     Route::get('/contact', [HomeController::class,'showContact']);
//     Route::get('/fabio', [HomeController::class,'showFabio']);

// });

// //Packages
// Route::get('/list-packages',[PackagesController::class,'showList']);
// Route::get('/details-package',[PackagesController::class,'showDetails']);


// //blog
// Route::get('/list-blogs',[BlogController::class,'showList']);
// Route::get('/details-blog',[BlogController::class,'showDetails']);

Route::group(['middleware' => 'locale'], function() {

Route::get('change-language/{language}', [HomeController::class,'changeLanguage'])->name('user.change-language');
Route::get('/', [HomeController::class,'index']);

//Tours
Route::get('/tours/list-tours',[TourController::class,'showList']);
Route::get('/tours/{url}',[TourController::class,'showDetails']);
Route::get('/tour-details/{url}',[TourController::class,'showPageTourDetails']);


//blog
Route::get('/list-blogs/{url}',[BlogController::class,'showList']);
Route::get('/blogs/{url}',[BlogController::class,'showDetails']);

Route::get('/about-us', [HomeController::class,'showAbout']);

//contact 
Route::get('/contact', [HomeController::class,'showContact']);
Route::get('/fabio', [HomeController::class,'showFabio']);
// Route::get('/{slug}/{slug2}/{slug3}', function ($slug, $slug2, $slug3) {
//     var_dump($slug);
//     var_dump($slug2);
//     var_dump($slug3);
//     die;
// });
// Route::get('/{slug}/{slug2}', function ($slug, $slug2) {
//     var_dump($slug);
//     var_dump($slug2);
//     die;
//     switch(@$lug) {
//         case($slug == 'contact');
//         return view('pages.contact.show')->with(compact('slug'));
//     }
// });
// Route::get('/{slug}', function ($slug) {
//     // var_dump($slug);
//     // die;
//     $url = UrlModel::where('request_path',$slug)->first();

//     if($url == null){
//         echo('die');
//         die;
//     }
//     switch($url) {
//         case($url->entity_type == 'pages');
//             $page = Pages::find($url->entity_id);
//             return view('pages.'.$page->url_key.'.show')->with(compact('page'));
//         case($slug == 'about-us');
//             return view('pages.contact.show')->with(compact('page'));
//         case($slug == 'fabio');
//             return view('pages.contact.show')->with(compact('page'));
//         case($slug == 'contact');
//             return view('pages.contact.show')->with(compact('page'));

//         default:
//             echo('die');
//     }
// });

});

