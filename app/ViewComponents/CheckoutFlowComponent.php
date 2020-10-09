<?php

namespace App\ViewComponents;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class CheckoutFlowComponent implements Htmlable
{
    protected array $parameters;

    protected array $steps = [
        1 => [
            'route' => 'shop.cart.index',
            'name' => 'My Cart',
            'status' => null,
        ],
        2 => [
            'route' => 'shop.checkout.showShipping',
            'name' => 'Shipping',
            'status' => null,
        ],
        3 => [
            'route' => 'shop.checkout.showRates',
            'name' => 'Rates',
            'status' => null,
        ],
        4 => [
            'route' => 'shop.checkout.showBilling',
            'name' => 'Payment',
            'status' => null,
        ],
        5 => [
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
            ->with(['steps' => $this->getSteps()]);
    }

    protected function initializeRoutes()
    {
        $currentRoute = Route::currentRouteName();
        $foundCurrent = false;

        foreach ($this->getSteps() as $i => $step) {
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

    protected function getSteps()
    {
        if (! config('shipping.custom_shipping')) {
            return $this->steps;
        }

        $processedSteps = [];

        foreach ($this->steps as $i => $step) {
            if ($step['name'] === 'Rates') {
                continue;
            }

            $processedSteps[$i] = $step;
        }

        return $processedSteps;
    }
}
