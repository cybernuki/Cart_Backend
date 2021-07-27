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
    Route::apiResource('products', 'ProductController');
});

Route::namespace('Client')->name('clients.')->group(function () {
    Route::apiResource('clients', 'ClientController');
});
