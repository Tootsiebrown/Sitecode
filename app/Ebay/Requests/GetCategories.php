<?php

namespace App\Ebay\Requests;

class GetCategories extends AbstractRequest
{
    protected array $data = [
        'GetCategoriesRequest' => [
            'ViewAllNodes' => true,
            'CategorySiteId' => 0,
            'DetailLevel' => 'ReturnAll',
            'LevelLimit' => 1,
        ],
    ];

    public function setVersion(int $version): void
    {
        $this->data['GetCategoriesRequest']['Version'] = $version;
    }

    public function setCategoryParent(int $parentId)
    {
        $this->data['GetCategoriesRequest']['CategoryParent'] = $parentId;
    }

    public function setLevelLimit(int $level)
    {
        $this->data['GetCategoriesRequest']['LevelLimit'] = $level;
    }
}
