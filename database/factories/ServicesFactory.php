<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'amount' => rand(100, 9999999),
        'category_id' => Category::first()->id,
    ];
});
