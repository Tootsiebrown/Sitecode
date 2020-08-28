<?php

return [
    'models' => [
        'product' => App\Wax\Shop\Models\Product::class,
        'payment_method' => Wax\Shop\Models\User\PaymentMethod::class,
        'order' => Wax\Shop\Models\Order::class,
    ],
    'inventory' => [
        'track' => false,

        /**
         * Limits how many of a single item can be added to cart by putting a ceiling on the "effective inventory".
         */
        'max_cart_quantity' => 10000,
    ],
];
