<?php

namespace App\ViewComponents;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\View;
use Wax\Shop\Services\ShopService;

class NavCartComponent implements Htmlable
{
    protected ShopService $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    public function toHtml()
    {
        $order = $this->shopService->getActiveOrder();
        $items = $order->default_shipment->items;

        return View::make('site.components.nav-cart')
            ->with([
                'order' => $order,
                'items' => $items,
            ]);
    }
}
