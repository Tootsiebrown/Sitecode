<?php

$factory->define(\App\Wax\Shop\Models\Order\ShippingRate::class, function (Faker\Generator $faker) {
    $amount = $faker->randomFloat(2, 3, 20);
    return [
        'shipment_id' => 0,
        'carrier' => $faker->company(),
        'service_code' => $faker->bothify('??#'),
        'service_name' => $faker->words(2, true),
        'business_transit_days' => null,
        'amount' => $amount,
        'box_count' => 1,
        'packaging' => '',
        'actual_amount' => $amount,
    ];
});
