<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\FileUploadController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    Route::post('/file_upload', [FileUploadController::class, 'upload']);
    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('demo/users', UserController::class);

});
