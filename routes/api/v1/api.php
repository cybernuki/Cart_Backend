<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Project's version 1 endpoints
|
*/

Route::apiResources([
    'products' => 'ProductController',
]);
