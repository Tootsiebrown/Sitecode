<?php

namespace App\Wax\Shop\Payment\Drivers;

use Omnipay\Stripe\Gateway;
use Wax\Core\Eloquent\Models\User;
use Wax\Shop\Models\Order;
use Wax\Shop\Models\Order\Payment;
use Wax\Shop\Models\User\PaymentMethod;
use Wax\Shop\Payment\Contracts\DriverTypes\StoredCreditCardDriverContract;

class StoredStripeDriver implements StoredCreditCardDriverContract
{
    protected $gateway;
    protected $user;

    public function __construct(Gateway $gateway)
    {
        $this->gateway = $gateway;
        $gateway->setApiKey(config('wax.shop.payment.drivers.stripe.secret_key'));
    }

    public function setUser(User $user) : StoredCreditCardDriverContract
    {
        $this->user = $user;

        return $this;
    }

    public function createCard($data): PaymentMethod
    {
        $response = $this->gateway->createCard($data)->send();

        $responseData = $response->getData();

        return new PaymentMethod([
            'payment_profile_id' => $response->getCardReference(),
            'brand' => $responseData['brand'],
            'masked_card_number' => $responseData['last4'],
            'expiration_date' => $responseData['exp_month'] . '/' . $responseData['exp_year'],
            'address' => $responseData['address_line1'],
            'zip' => $responseData['address_zip'],
            'name' => $responseData['name'],
        ]);
    }

    public function createProfile()
    {
        return $this
            ->gateway
            ->createCustomer([
                'email' => $this->user->email,
                'name' => $this->user->name,
            ])
            ->send()
            ->getCustomerReference();


    }

    public function updateCard($data, PaymentMethod $originalPaymentMethod): PaymentMethod
    {
        // TODO: Implement updateCard() method.
    }

    public function deleteCard(PaymentMethod $paymentMethod)
    {
        // TODO: Implement deleteCard() method.
    }

    public function purchase(Order $order, PaymentMethod $paymentMethod, float $amount): Payment
    {
        // TODO: Implement purchase() method.
    }
}
