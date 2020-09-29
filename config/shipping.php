<?php

return [
    'services' => [
        'USPS Priority Mail - Package',
        'USPS Priority Mail Express - Package',
        'USPS Parcel Select Ground - Package',
        'FedEx Ground®',
    ],

    'carriers' => [
        'stamps_com',
        'fedex',
        // 'ups_walleted',
    ],

    'free_shipping_threshold' => 50,
    'free_shipping_service' => 'USPS Parcel Select Ground - Package',
];
