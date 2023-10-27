<?php

use DDDD\EAVAttribute\Http\Controllers\EAVAttributeController;
use DDDD\EAVAttribute\Http\Controllers\EAVAttributeSetController;
use DDDD\EAVAttribute\Http\Controllers\EAVAttributeGroupController;


Route::resource('eav-attributes', EAVAttributeController::class);

Route::resource('eav-attribute-groups', EAVAttributeGroupController::class);

Route::resource('eav-attribute-sets', EAVAttributeSetController::class);

