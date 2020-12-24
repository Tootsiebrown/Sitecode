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
                'ListingDuration' => 'GTC',
                'ListingType' => 'FixedPriceItem',
                'PrimaryCategory' => [
                    'CategoryID' => null,
                ],
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
}
