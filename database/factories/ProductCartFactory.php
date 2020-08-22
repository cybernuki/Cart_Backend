<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductCar;
use Faker\Generator as Faker;

$factory->define(ProductCar::class, function (Faker $faker) {
    return [
        'product_id' => rand(1 , App\Product::count()),
        'cart_id' => rand(1, App\Cart::count()),
        'quantity' => rand(0, 51)
    ];
});
