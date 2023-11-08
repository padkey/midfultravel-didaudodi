<?php

use DDDD\Subscription\Http\Controllers\ProductSubscriptionController;
use DDDD\Subscription\Http\Controllers\SubscriptionController;
use DDDD\TourEnquire\Http\Controllers\TourEnquireController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $router->resource('product-subscription', ProductSubscriptionController::class);
    $router->resource('subscription', SubscriptionController::class);
    $router->resource('tour-enquire', TourEnquireController::class);

});
