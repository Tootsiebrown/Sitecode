<?php

namespace App\Wax\Shop\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Wax\Shop\Exceptions\ValidationException;
use Wax\Shop\Services\ShopService;

class CheckoutController extends Controller
{
    protected $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    /**
     * Place an order. This would be used when the order is completely set up and payments/discounts have been
     * applied to bring the balance due to $0.00.
     *
     * @return Response
     * @throws ValidationException
     */
    public function placeOrder()
    {
        $this->shopService->placeOrder();

        return response()->json(true);
    }

    public function checkout()
    {
        if ($this->shopService->getActiveOrder()->item_count > 0) {
            return redirect()->route('shop.checkout.showShipping');
        } else {
            return redirect()->route('shop.cart');
        }
    }

    public function showShipping()
    {
        if ($this->shopService->getActiveOrder()->item_count === 0) {
            return redirect()->route('shop.cart');
        }

        return view('shop.checkout.shipping');
    }

    public function saveShipping(Request $request)
    {
        $shipment = $this->shopService->getActiveOrder()->default_shipment;

        if ($request->input('in_store_pickup')) {
            $shipment->in_store_pickup = true;
            $shipment->save();

            return redirect()->route('shop.checkout.showBilling');
        }

        $shipment->in_store_pickup = false;
        $shipment->save();

        $shipment->setAddress(
            $request->input('firstName'),
            $request->input('lastName'),
            $request->input('company'),
            $request->input('email'),
            $request->input('phone'),
            $request->input('address1'),
            $request->input('address2'),
            $request->input('city'),
            $request->input('state'),
            $request->input('zip'),
            'USA'
        );

        return redirect()->route('shop.checkout.showBilling');
    }

    public function showBilling(Request $request)
    {
        return view('shop.checkout.billing', [
            'stripePublishableKey' => config('wax.shop.payments.drivers.stripe.publishable_key'),
        ]);
    }
}
