<?php

namespace App\Http\Controllers;

use App\Wax\Shop\Validators\OrderCouponValidator;
use Illuminate\Http\Request;
use Wax\Shop\Exceptions\ValidationException;
use App\Wax\Shop\Models\Coupon;
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
        $coupon = Coupon::where('code', $request->input('code'))->first();
        $order = $this->shopService->getActiveOrder();

        if (!$coupon) {
            return view('site.components.checkout-cart', [
                'order' => $order,
                'couponMessage' => __('shop::coupon.invalid_code'),
            ]);
        }

        $validator = new OrderCouponValidator(
            $order,
            $coupon
        );

        if (!$validator->passes()) {
            return view('site.components.checkout-cart', [
                'order' => $order,
                'couponMessage' => implode(' ', $validator->messages()->get('general')),
            ]);
        }

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
