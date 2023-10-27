<?php


use DDDD\Tour\Http\Controllers\TourController;
use DDDD\Tour\Http\Controllers\TourScheduleController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $router->resource('tour-schedule',TourScheduleController::class);
    $router->resource('tour', TourController::class);
});
