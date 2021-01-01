<?php

namespace App\Ebay\Requests;

class GetCategoryFeatures extends AbstractRequest
{
    protected array $data = [
        'GetCategoryFeaturesRequest' => [
            'AllFeaturesForCategory' => true,
            'ViewAllNodes' => true,
            'DetailLevel' => 'ReturnAll',
            'LevelLimit' => 7
        ],
    ];

    public function setVersion(int $version): void
    {
        $this->data['GetCategoryFeaturesRequest']['Version'] = $version;
    }

    public function setCategoryId($categoryId)
    {
        $this->data['GetCategoryFeaturesRequest']['CategoryID'] = $categoryId;
    }

    public function setFeatures(array $features)
    {
        $this->data['GetCategoryFeaturesRequest']['AllFeaturesForCategory'] = false;
        $this->data['GetCategoryFeaturesRequest']['FeatureID'] = $features;

    }
}
