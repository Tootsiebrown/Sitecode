<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Wax\Shop\Repositories\OrderRepository;
use Wax\Shop\Services\ShopService;

class CheckoutPromoCodesController extends Controller
{
    protected $shopService;
    protected $orderRepo;

    public function __construct(ShopService $shopService, OrderRepository $orderRepo)
    {
        $this->shopService = $shopService;
        $this->orderRepo = $orderRepo;
    }

    public function store(Request $request)
    {
        if (!$this->shopService->applyCoupon($request->input('code'))) {
            $order = $this->shopService->getActiveOrder();
            return view('site.components.checkout-cart', [
                'order' => $order,
                'couponMessage' => __('shop::coupon.invalid_code'),
            ]);
        }

        $order = $this->shopService->getActiveOrder();
        return view('site.components.checkout-cart', [
            'order' => $order,
        ]);
    }

    public function destroy()
    {
        $this->shopService->removeCoupon();

        $order = $this->shopService->getActiveOrder();
        return view('site.components.checkout-cart', [
            'order' => $order,
            'couponMessage' => 'Coupon Removed',
        ]);
    }
}
