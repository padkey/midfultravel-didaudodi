<?php

use DDDD\CatalogProduct\CatalogProduct;
use DDDD\CatalogProduct\Http\Ajax\ProductHotSaleAjax;
use DDDD\CatalogProduct\Http\Ajax\ProductVersionAjax;
use DDDD\CatalogProduct\Http\Controllers\CatalogProductController;
use DDDD\CatalogProduct\Http\Controllers\FrameLayerController;
use DDDD\CatalogProduct\Http\Controllers\HotSaleController;
use DDDD\CatalogProduct\Http\Controllers\ProductTagController;
use DDDD\CatalogProduct\Http\Controllers\ProductVersionGroupController;
use DDDD\CatalogProduct\Http\Controllers\ReplicateProductController;
use DDDD\CatalogProduct\Http\Controllers\TextPromotionManagerController;
use DDDD\CatalogProduct\Http\Controllers\WebPriceController;
use DDDD\Faq\Http\Controllers\ProductFAQController;
use Illuminate\Support\Facades\Route;

Route::resource('catalog-product', CatalogProductController::class);
Route::resource('product-tag', ProductTagController::class);
Route::resource('product-version', ProductVersionGroupController::class);
Route::resource('hot-sale', HotSaleController::class);
Route::resource('hot-sale-product-ajax', ProductHotSaleAjax::class);
Route::resource('product-version-ajax', ProductVersionAjax::class);
Route::resource('text-promotion-manager',TextPromotionManagerController::class);
Route::resource('web-price', WebPriceController::class);
Route::get('update-web-price/{sku}/{region}/{price}/{sale_price}', [WebPriceController::class, 'updateWebPrice']);

Route::resource(CatalogProduct::FRAME_LAYER_PERMISSION_SLUG,FrameLayerController::class);
Route::get('replicate-product/{id}', [ReplicateProductController::class, 'index']);
