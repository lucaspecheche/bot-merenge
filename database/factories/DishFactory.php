<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Dish::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'label' => $faker->name
    ];
});
