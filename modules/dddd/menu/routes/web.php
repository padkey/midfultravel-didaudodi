<?php

use DDDD\Menu\Http\Controllers\MenuAdminController;
use DDDD\Menu\Http\Controllers\MenuItemsAdminController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $router->resource('menu', MenuAdminController::class);
    $router->resource('menu-items', MenuItemsAdminController::class);
});

