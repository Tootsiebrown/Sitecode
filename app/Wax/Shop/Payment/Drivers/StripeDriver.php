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
    public function purchase($order, $token, $amount, $lastFour): Payment
    {
        $response = $this->gateway->purchase([
            'amount' => $amount,
            'currency' => 'USD',
            'token' => $token,
        ])->send();

        if ($response->isSuccessful()) {
            // payment was successful: update database
            return new Payment([
                'type' => 'stripe_cc',
                'authorized_at' => Carbon::now(),
                'captured_at' => Carbon::now(),
                'account' => $lastFour,
                'error' => 'The payment was successful.',
                'response' => 'CAPTURED',
                'amount' => $amount,
            ]);
        }

        // payment failed: display message to customer
        return new Payment([
            'type' => 'stripe_cc',
            'authorized_at' => Carbon::now(),
            'captured_at' => Carbon::now(),
            'account' => $lastFour,
            'error' => $response->getMessage(),
            'response' => 'DECLINED',
            'amount' => $amount,
        ]);
    }
}
