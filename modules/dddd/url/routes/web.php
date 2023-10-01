<?php

use DDDD\Url\Http\Controllers\UrlController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $router->resource('url', UrlController::class);
});
