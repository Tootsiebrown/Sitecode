<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sendgrid' => [
        'api_key' => env('SENDGRID_API_KEY'),
        'version' => 'v3',
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'ship_station' => [
        'api_key' => env('SHIPSTATION_API_KEY'),
        'api_secret' => env('SHIPSTATION_API_SECRET'),
        'api_url' => env('SHIPSTATION_API_URL'),
        'from_postal_code' => 40701,
        'store_id' => env('SHIPSTATION_STORE_ID'),
    ],

    'ebay' => [
        'test_mode' => env('EBAY_TEST_MODE', false),
        'app_id' => env('EBAY_APP_ID'),
        'merchant_location_key' => env('EBAY_MERCHANT_LOCATION_KEY'),
        'fulfillment_policy_id' => env('EBAY_FULFILLMENT_POLICY_ID'),
        'return_policy_id' => env('EBAY_RETURN_POLICY_ID'),
        'payment_policy_id' => env('EBAY_PAYMENT_POLICY_ID'),
        'oauth' => [
            'client_id' => env('EBAY_OAUTH_CLIENT_ID'),
            'client_secret' => env('EBAY_OAUTH_CLIENT_SECRET'),
            'redirect' => env('EBAY_OAUTH_REDIRECT_URI'),
            'test_mode' => env('EBAY_OAUTH_TEST_MODE', false),
        ],
        'legacy' => [
            'app_id' => env('EBAY_APP_ID'),
            'api_token' => env('EBAY_LEGACY_TOKEN'),
            'test_mode' => env('EBAY_TEST_MODE', false),
            'api_version' => env('EBAY_LEGACY_API_VERSION')
        ],
        'scopes' => [
            'https://api.ebay.com/oauth/api_scope',
            'https://api.ebay.com/oauth/api_scope/sell.account',
            'https://api.ebay.com/oauth/api_scope/sell.finances',
            'https://api.ebay.com/oauth/api_scope/sell.inventory',

        ]
    ]

];
