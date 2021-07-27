<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'last_name' => $faker->name,
        'document' => '12345678',
    ];
});
