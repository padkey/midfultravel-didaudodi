<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PartnershipController;

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


Route::group(['middleware' => 'locale'], function() {

    Route::get('change-language/{language}', [HomeController::class,'changeLanguage'])->name('user.change-language');
    Route::get('/', [HomeController::class,'index']);
    //Route::get('/', [TourController::class,'showDetails2']);

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

    //partnership

    Route::get('/partnership-branch/{url}',[PartnershipController::class,'partnershipBranchDetails']);
});

