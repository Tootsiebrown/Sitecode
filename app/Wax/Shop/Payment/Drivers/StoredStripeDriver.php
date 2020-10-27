<?php

namespace App\Wax\Shop\Payment\Drivers;

use Illuminate\Support\Carbon;
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

        $namePieces = explode(' ', $responseData['name']);
        $firstname = array_shift($namePieces);
        $lastname = implode(' ', $namePieces);

        return new PaymentMethod([
            'payment_profile_id' => $response->getCardReference(),
            'brand' => $responseData['brand'],
            'masked_card_number' => $responseData['last4'],
            'expiration_date' => $responseData['exp_month'] . '/' . $responseData['exp_year'],
            'address' => $responseData['address_line1'],
            'zip' => $responseData['address_zip'],
            'firstname' => $firstname,
            'lastname' => $lastname,
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
        $response = $this->gateway->purchase([
            'amount' => $amount,
            'currency' => 'USD',
            'paymentMethod' => $paymentMethod->payment_profile_id,
            'description' => 'order_id ' . $order->id,
            'customerReference' => $paymentMethod->user->payment_profile_id
        ])->send();

        if ($response->isSuccessful()) {
            // payment was successful: update database
            return new Payment([
                'type' => 'stripe-stored',
                'authorized_at' => Carbon::now(),
                'captured_at' => Carbon::now(),
                'account' => $paymentMethod->masked_card_number,
                'error' => 'The payment was successful.',
                'response' => 'CAPTURED',
                'amount' => $amount,
                'zip' => $paymentMethod->zip,
                'brand' => $paymentMethod->brand,
                'transaction_ref' => $response->getTransactionReference(),
                'auth_code' => $response->getBalanceTransactionReference(),
                'firstname' => $paymentMethod->firstname,
                'lastname' => $paymentMethod->lastname,
                'address1' => $paymentMethod->address,
                'address2' => isset($response->getData()['source']['address_line2'])
                    ? $response->getData()['source']['address_line2']
                    : '',
                'city' => isset($response->getData()['source']['address_city'])
                    ? $response->getData()['source']['address_city']
                    : '',
                'state' => isset($response->getData()['source']['address_state'])
                    ? $response->getData()['source']['address_state']
                    : '',
            ]);
        }

        // payment failed: display message to customer
        return new Payment([
            'type' => 'stripe_cc',
            'account' => $paymentMethod->masked_card_number,
            'error' => $response->getMessage(),
            'response' => 'ERROR',
            'amount' => $amount,
            'zip' => $paymentMethod->zip,
            'brand' => $paymentMethod->brand,
            'transaction_ref' => $response->getTransactionReference(),
        ]);
    }
}
