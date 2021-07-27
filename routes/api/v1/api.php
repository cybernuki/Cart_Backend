<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Project's version 1 endpoints
|
*/

Route::namespace('Product')->name('products.')->group(function () {
    Route::apiResources([
        'products' => 'ProductController',
    ]);
});
