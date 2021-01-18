<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Currency::class, function (Faker $faker) {
    return [
        'name' => "Ghana Cedi",
        'code' => "GHC",
        'sign' => "¢"
    ];
});
