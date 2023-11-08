<?php

use Illuminate\Support\Facades\Route;

Route::post('/product-subscription', 'DTV\Subscription\Http\Apis\ProductSubscriptionApi@submit');
Route::post('/subscription', 'DTV\Subscription\Http\Apis\SubscriptionApi@submit');

Route::post('/tour-enquire', 'DDDD\TourEnquire\Http\Apis\TourEnquireApi@submit');