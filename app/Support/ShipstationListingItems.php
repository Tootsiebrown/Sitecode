<?php

namespace App\Support;

use App\Wax\Shop\Models\Order;
use Illuminate\Support\Collection;

class ShipstationListingItems
{
    /** @var Collection */
    private Collection $itemIds;
    private string $sku;
    private int $skuCount;
    /** @var int|string */
    private int $customFieldTwoCount;
    private int $customFieldThreeCount;
    private string $customFieldTwo;
    private string $customFieldThree;

    public function __construct(Order $order)
    {
        $this->itemIds = $order->items
            ->map(fn($item) => $item->listingItems)
            ->flatten()
            ->pluck('id');

        $this->initSkuStrings();
    }

    protected function initSkuStrings()
    {
        $this->initItemSku();
        //custom field 1 is the listing skus, not item skus
        $this->initCustomFieldTwo();
        $this->initCustomFieldThree();
    }

    public function initItemSku()
    {
        $this->sku = $this->buildString($this->itemIds, 200, $count);
        $this->skuCount = $count;
    }

    protected function initCustomFieldTwo()
    {
        $customFieldTwoIds = $this->itemIds->slice($this->skuCount);

        $this->customFieldTwo = $this->buildString($customFieldTwoIds, 89, $count);
        $this->customFieldTwoCount = $count;
    }

    protected function initCustomFieldThree()
    {
        $customFieldThreeIds = $this->itemIds->slice($this->skuCount + $this->customFieldTwoCount);

        $this->customFieldThree = $this->buildString($customFieldThreeIds, 89, $count);
        $this->customFieldThreeCount = $count;
    }

    protected function buildString(Collection $ids, int $length, &$count)
    {
        $string = '';
        $testString = '';
        $count = 0;

        foreach ($ids as $i => $id) {
            if ($count + 1 > 1) {
                $testString .= ', ' . $id;
                if (strlen($testString) <= $length) {
                    $string = $testString;
                    $count++;
                } else {
                    break;
                }
            } else {
                $count++;
                $string = $id;
                $testString = $id;
            }
        }

        return $string;
    }

    public function hasCustomFieldTwoOverflow()
    {
        return $this->skuCount < $this->itemIds->count();
    }

    public function hasCustomFieldThreeOverflow()
    {
        return $this->skuCount + $this->customFieldTwoCount < $this->itemIds->count();
    }

    public function hasTotalOverflow()
    {
        return
            $this->skuCount + $this->customFieldTwoCount + $this->customFieldThreeCount
            <
            $this->itemIds->count();
    }

    public function tooLongForCustomField(string $string)
    {
        //customFields have maxlength of 114
        return strlen($string) > 114;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function getCustomFieldTwo()
    {
        return $this->customFieldTwo;
    }

    public function getCustomFieldThree()
    {
        return $this->customFieldThree;
    }
}
