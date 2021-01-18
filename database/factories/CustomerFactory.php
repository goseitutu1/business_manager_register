<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'location' => $faker->country,
        'phone_number' => $faker->phoneNumber,
        'email' => trim($faker->unique()->safeEmail),
    ];
});
