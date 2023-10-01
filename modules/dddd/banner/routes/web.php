<?php

use DTV\Banner\Http\Controllers\BannerAdminController;
use DTV\Banner\Http\Controllers\BannerItemsAdminController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $router->resource('banner', BannerAdminController::class);
    $router->resource('banner-items', BannerItemsAdminController::class);
});

