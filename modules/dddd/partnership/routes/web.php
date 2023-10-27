<?php


use DDDD\Partnership\Http\Controllers\PartnershipController;
use DDDD\Partnership\Http\Controllers\PartnershipBranchController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $router->resource('partnership-branch',PartnershipBranchController::class);
    $router->resource('partnership', PartnershipController::class);
});
