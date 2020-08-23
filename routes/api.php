<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('carts', 'CartController@store');
Route::get('carts', 'CartController@index');
Route::get('carts/{cart}', 'CartController@show');
Route::put('carts/{cart}', 'CartController@update');
Route::delete('carts/{cart}', 'CartController@destroy');

Route::post('products', 'ProductController@store');
Route::get('products', 'ProductController@index');
Route::get('products/{product}', 'ProductController@show');
Route::put('products/{product}', 'ProductController@update');
Route::delete('products/{product}', 'ProductController@destroy');

Route::post('product_cars', 'ProductCarController@store');
Route::get('product_cars', 'ProductCarController@index');
Route::get('product_cars/{productCar}', 'ProductCarController@show');
Route::put('product_cars/{productCar}', 'ProductCarController@update');
Route::delete('product_cars/{productCar}', 'ProductCarController@destroy');