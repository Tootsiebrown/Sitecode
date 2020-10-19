<?php

namespace App\Wax\Shop\Payment\Drivers;

use Omnipay\Stripe\Gateway;
use Wax\Shop\Models\Order\Payment;
use Illuminate\Support\Carbon;

class StripeDriver
{
    protected $gateway;

    public function __construct(Gateway $gateway)
    {
        $this->gateway = $gateway;
        $gateway->setApiKey(config('wax.shop.payment.drivers.stripe.secret_key'));
    }
    public function purchase(
        $order,
        $token,
        $amount,
        $lastFour,
        $zip,
        $brand,
        $address
    ): Payment {
        $response = $this->gateway->purchase([
            'amount' => $amount,
            'currency' => 'USD',
            'token' => $token,
            'description' => 'order_id ' . $order->id,

        ])->send();

        if ($response->isSuccessful()) {
            // payment was successful: update database
            return new Payment([
                'type' => 'stripe-cc',
                'authorized_at' => Carbon::now(),
                'captured_at' => Carbon::now(),
                'account' => $lastFour,
                'error' => 'The payment was successful.',
                'response' => 'CAPTURED',
                'amount' => $amount,
                'zip' => $zip,
                'brand' => $brand,
                'transaction_ref' => $response->getTransactionReference(),
                'auth_code' => $response->getBalanceTransactionReference(),
                'firstname' => $address['firstname'],
                'lastname' => $address['lastname'],
                'address1' => $address['address1'],
                'address2' => $address['address2'] ?? '',
                'city' => $address['city'],
                'state' => $address['state'],
            ]);
        }

        // payment failed: display message to customer
        return new Payment([
            'type' => 'stripe_cc',
            'account' => $lastFour,
            'error' => $response->getMessage(),
            'response' => 'ERROR',
            'amount' => $amount,
            'zip' => $zip,
            'brand' => $brand,
            'transaction_ref' => $response->getTransactionReference(),
        ]);
    }
}
