<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'sku' => $faker->unique()->uuid,
        'description' => $faker->paragraph(3),
        'price' => $faker->randomFloat(2, 100, 1000)
    ];
});
