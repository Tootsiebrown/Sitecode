<?php

namespace App\ViewComponents;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\View;
use Wax\Shop\Services\ShopService;

class CartCountComponent implements Htmlable
{
    protected ShopService $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    public function toHtml()
    {
        $count = $this->shopService->getActiveOrder()->item_count;

        if ($count === 0) {
            return '';
        }

        return View::make('site.components.cart-count')
            ->with(['count' => $count]);
    }
}
