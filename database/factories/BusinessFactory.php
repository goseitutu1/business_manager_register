<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Business::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'location' => $faker->address,
        'type' => "company",
        'logo' => $faker->imageUrl(),
        'currency_id' => function () {
            return App\Models\Currency::first()->id;
        },
        // replace this with currency seeder
        'reg_no' => substr(str_shuffle(md5(time())), 0, 10),
        'vat_no' => substr(str_shuffle(md5(time())), 0, 10),
        'tax_no' => substr(str_shuffle(md5(time())), 0, 10),
        'owner_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        }
    ];
});
