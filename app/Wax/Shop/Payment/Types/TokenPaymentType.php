<?php

namespace App\Wax\Shop\Payment\Types;

use Exception;
use Wax\Shop\Models\Order\Payment;
use Wax\Shop\Payment\Contracts\PaymentTypeContract;

class TokenPaymentType implements PaymentTypeContract
{
    protected $token;
    protected $lastFour;
    protected $zip;
    protected $brand;
    protected array $address;

    protected function getDriver()
    {
        return app()->make(config('wax.shop.payment.credit_card_payment_driver'));
    }

    public function authorize($order, $amount): Payment
    {
        throw new Exception('Prior auth / Capture is not an implemented payment method');
    }

    public function purchase($order, $amount): Payment
    {
        return $this->getDriver()->purchase(
            $order,
            $this->token,
            $amount,
            $this->lastFour,
            $this->zip,
            $this->brand,
            $this->address,
        );
    }

    public function capture(Payment $payment)
    {
        throw new Exception('Prior auth / Capture is not an implemented payment method');
    }

    public function loadData($data)
    {
        $this->token = $data['token'];
        $this->lastFour = $data['lastFour'];
        $this->zip = $data['zip'];
        $this->brand = $data['brand'];
        $this->address = $data['address'];
    }
}
