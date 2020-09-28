<?php

namespace App\ViewComponents;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class CheckoutFlowComponent implements Htmlable
{
    protected array $parameters;

    protected array $steps = [
        [
            'route' => 'shop.cart.index',
            'name' => 'My Cart',
            'status' => null,
        ],
        [
            'route' => 'shop.checkout.showShipping',
            'name' => 'Shipping',
            'status' => null,
        ],
        [
            'route' => 'shop.checkout.showRates',
            'name' => 'Rates',
            'status' => null,
        ],
        [
            'route' => 'shop.checkout.showBilling',
            'name' => 'Payment',
            'status' => null,
        ],
        [
            'route' => 'shop.checkout.confirmation',
            'name' => 'Confirmation',
            'status' => null,
        ],
    ];

    public function __construct()
    {
        $this->initializeRoutes();
    }

    public function toHtml()
    {
        return View::make('site.components.checkout-flow-header')
            ->with(['steps' => $this->steps]);
    }

    protected function initializeRoutes()
    {
        $currentRoute = Route::currentRouteName();
        $foundCurrent = false;

        foreach ($this->steps as $i => $step) {
            $this->steps[$i]['status'] = 'past';

            if ($step['route'] === $currentRoute) {
                $this->steps[$i]['status'] = 'current';
                $foundCurrent = true;

                continue;
            }

            if ($foundCurrent) {
                $this->steps[$i]['status'] = 'future';
            }
        }
    }
}
