<?php

namespace App\ViewComponents;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\View;
use Wax\Shop\Services\ShopService;

class CheckoutCartComponent implements Htmlable
{
    protected $shopService;

    public function __construct(
        ShopService $shopService
    ) {
        $this->shopService = $shopService;
    }

    public function toHtml()
    {
        return View::make('site.components.checkout-cart')
            ->with([
                'order' => $this->shopService->getActiveOrder(),
            ]);
    }
}
