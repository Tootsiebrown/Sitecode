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
            ],
        ],
    ];

    public function setVersion(int $version): void
    {
        $this->data['AddFixedPriceItemRequest']['Version'] = $version;
    }
}
