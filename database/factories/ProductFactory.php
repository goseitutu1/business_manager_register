<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        "name" => $faker->sentence(10),
        "cost_price" => rand(10, 1000000),
        'selling_price' => rand(10, 1000000),
        'quantity' => rand(200, 1000000),
        'stock_threshold' => rand(0, 200),
        'location' => $faker->address,
        'category_id' => Category::first()->id,
    ];
});
