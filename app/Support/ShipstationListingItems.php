<?php


namespace App\Support;


use App\Wax\Shop\Models\Order;
use Illuminate\Support\Collection;

class ShipstationListingItems
{
    /** @var Collection */
    private Collection $itemIds;

    public function __construct(Order $order)
    {
        $this->itemIds = $order->items
            ->map(fn($item) => $item->listingItems)
            ->flatten()
            ->pluck('id');
    }

    public function getShipstationItemSku()
    {
        $maxLength = 230;

        $sku = '';
        $testSku = '';;
        $i = 1;

        foreach ($this->itemIds as $i => $id) {
            if ($i > 1) {
                $testSku .= ', ' . $id;
                if (strlen($testSku) <= $maxLength) {
                    $sku = $testSku;
                } else {
                    break;
                }
            }

            $i++;
        }

        $this->skuCount = $i;
        return $sku;
    }


}
