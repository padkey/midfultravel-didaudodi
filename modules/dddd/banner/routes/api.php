<?php

use Illuminate\Support\Facades\Route;

Route::get('banner/{uuid}', 'DTV\Banner\Http\Controllers\BannerController@get');
