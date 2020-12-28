<?php

namespace App\Ebay\Requests;

class AddFixedPriceItem extends AbstractRequest
{
    protected array $data = [
        'AddFixedPriceItemRequest' => [
            'Item' => [
                'AutoPay' => true,
                'BestOfferDetails' => [
                    'BestOfferEnabled' => true,
                ],
                'CategoryMappingAllowed' => true,
                'Currency' => 'USD',
                'Country' => 'US',
                'ConditionDescription' => null,
                'ConditionID' => null,
                'Description' => null,
                'DispatchTimeMax' => 2,
                'ListingDuration' => 'GTC',
                'ListingType' => 'FixedPriceItem',
                'PrimaryCategory' => [
                    'CategoryID' => null,
                ],
                'Quantity' => 1,
                'StartPrice' => null,
            ],
        ],
    ];

    public function setVersion(int $version): void
    {
        $this->data['AddFixedPriceItemRequest']['Version'] = $version;
    }

    public function setConditionId(int $conditionId)
    {
        $this->data['AddFixedPriceItemRequest']['Item']['ConditionId'] = $conditionId;
    }

    public function setConditionDescription(string $conditionDescription)
    {
        $this->data['AddFixedPriceItemRequest']['Item']['ConditionDescription'] = $conditionDescription;
    }

    public function setDescription(string $description)
    {
        $this->data['AddFixedPriceItemRequest']['Item']['Description'] = $description;
    }

    public function setPrimaryCategoryId($categoryId)
    {
        $this->data['AddFixedPriceItemRequest']['Item']['PrimaryCategory']['CategoryID'] = $categoryId;
    }

    public function setPrice(float $price)
    {
        $this->data['AddFixedPriceItemRequest']['Item']['StartPrice'] = $price;
    }

    public function setPostalCode($code)
    {
        $this->data['AddFixedPriceItemRequest']['Item']['PostalCode'] = $code;
    }

    public function setQuantity(int $quantity)
    {
        $this->data['AddFixedPriceItemRequest']['Item']['Quantity'] = $quantity;
    }

    public function setTitle(string $title)
    {
        $this->data['AddFixedPriceItemRequest']['Item']['Title'] = $title;
    }

    public function setPaymentMethods(string $paypalEmail)
    {
        $this->data['AddFixedPriceItemRequest']['Item']['PaymentMethods'] = [
            'PayPal'
        ];
        $this->data['AddFixedPriceItemRequest']['Item']['PayPalEmailAddress'] = $paypalEmail;
    }

    public function setShippingDetails($shippingCost, $secondItemShippingCost)
    {
        $this->data['AddFixedPriceItemRequest']['Item']['ShippingDetails'] = [
            'ShippingServiceOptions' => [
                [
                    'ShippingService' => 'UPSGround',
                    'ShippingServiceCost' => $shippingCost,
                    'ShippingServiceAdditionalCost' => $secondItemShippingCost,

                ],
            ],
            'ShippingType' => 'Flat',
        ];
    }
}
