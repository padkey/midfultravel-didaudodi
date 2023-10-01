<?php

use DDDD\Blog\Http\Controllers\BlogController;
use DDDD\Blog\Http\Controllers\BlogPostController;
use DDDD\Blog\Http\Controllers\BlogCategoryController;
use DDDD\Blog\Http\Controllers\PagesController;
use DDDD\Blog\Http\Controllers\TourController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $router->resource('blog-category', BlogCategoryController::class);
    $router->resource('blog-post', BlogPostController::class);
    // $router->resource('blog-tag', BlogTagController::class);
    $router->resource('pages', PagesController::class);
   //$router->resource('tour', TourController::class);
});