<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Models\Listing::class, function (Faker $faker) {
    $title = $faker->words(3, true);
    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'status' => 1,
        'type' => 'set-price',
        'price' => 10,
    ];
});
