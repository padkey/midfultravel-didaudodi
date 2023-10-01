<?php

use DDDD\Blog\Http\Controllers\BlogController;
use DDDD\Blog\Http\Controllers\BlogPostController;
use DDDD\Blog\Http\Controllers\BlogCategoryController;
use DDDD\Blog\Http\Controllers\PagesController;
use DDDD\Tour\Http\Controllers\TourController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->resource('tour', TourController::class);
});