<?php

return [
    'services' => [
        'USPS Priority Mail - Package',
        'USPS Priority Mail Express - Package',
        'USPS Parcel Select Ground - Package',
        'FedEx Ground®',
        'Custom Shipping',
    ],

    'carriers' => [
        'stamps_com',
        'fedex',
        // 'ups_walleted',
        'custom'
    ],

    'free_shipping_threshold' => 50,
    'free_shipping_service' => 'USPS Parcel Select Ground - Package',

    'custom_shipping' => true,

    'custom_shipping_tiers' => [
        50 => 0,
        30 => 8.99,
        10 => 5.99,
        0 => 2.99,
    ],
];
