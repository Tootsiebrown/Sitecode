<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Listing\Item::class, function (Faker $faker) {
    return [
        'bin' => $faker->word,
    ];
});

