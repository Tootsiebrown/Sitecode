<?php

use Illuminate\Support\Carbon;

$factory->define(App\ProductCategory::class, function (Faker\Generator $faker) {
    $name = $faker->catchPhrase();
    return [
        'name' => $name,
        'breadcrumb' => $name,
        'parent_id' => 0,
    ];
});
