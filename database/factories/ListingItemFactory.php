<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Listing\Item::class, function (Faker $faker) {
    $title = $faker->words(3, true);
    return [
        'bin' => $faker->word,
    ];
});

