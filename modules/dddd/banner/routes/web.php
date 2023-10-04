<?php

use DDDD\Banner\Http\Controllers\BannerAdminController;
use DDDD\Banner\Http\Controllers\BannerItemsAdminController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $router->resource('banner', BannerAdminController::class);
    $router->resource('banner-items', BannerItemsAdminController::class);
});

