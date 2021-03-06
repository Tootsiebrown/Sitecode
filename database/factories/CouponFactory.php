<?php

use Illuminate\Support\Carbon;

$factory->define(App\Wax\Shop\Models\Coupon::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->catchPhrase(),
        'code' => $faker->bothify('????####'),
        'expired_at' => Carbon::tomorrow(),
        'dollars' => 0,
        'minimum_order' => 0,
        'one_time' => false,
        'include_shipping' => false,
        'uses' => 0,
        'category_id' => null,
        'listing_id' => null,
    ];
});
