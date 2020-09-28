<?php

return [
    'models' => [
        'product' => App\Wax\Shop\Models\Product::class,
        'payment_method' => Wax\Shop\Models\User\PaymentMethod::class,
        'order' => App\Wax\Shop\Models\Order::class,
    ],
    'inventory' => [
        'track' => false,

        /**
         * Limits how many of a single item can be added to cart by putting a ceiling on the "effective inventory".
         */
        'max_cart_quantity' => 10000,
    ],
    'payment' => [
        'auth_capture' => true,
        'drivers' => [
            'stripe' => [
                'publishable_key' => env('STRIPE_PUBLISHABLE_KEY'),
                'secret_key' => env('STRIPE_SECRET_KEY'),
            ]
        ],
        'stored_payment_driver' => \Wax\Shop\Payment\Drivers\StoredStripeDriver::class,
        'credit_card_payment_driver' => App\Wax\Shop\Payment\Drivers\StripeDriver::class,
        'types' => [
            'credit_card' => \Wax\Shop\Payment\Types\CreditCard::class,
            'stored_credit_card' => \Wax\Shop\Payment\Types\StoredCreditCard::class,
        ],
    ],
    'listeners' => [
        'place_order' => [
            \Wax\Shop\Listeners\OrderPlaced\CouponListener::class,
            \Wax\Shop\Listeners\OrderPlaced\EmailListener::class,
            \Wax\Shop\Listeners\OrderPlaced\InventoryListener::class,
            \Wax\Shop\Listeners\OrderPlaced\CommitTaxListener::class,
            \Wax\Shop\Listeners\OrderPlaced\ProcessOrderListener::class,
        ],
    ],
];
