<?php

namespace App\Wax\Shop\Controllers;

use App\Http\Controllers\Controller;
use App\Wax\Shop\Payment\Types\TokenPaymentType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Wax\Shop\Exceptions\ValidationException;
use Wax\Shop\Payment\Types\CreditCard;
use Wax\Shop\Services\ShopService;

class CheckoutController extends Controller
{
    protected $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    public function checkout()
    {
        if ($this->shopService->getActiveOrder()->item_count > 0) {
            return redirect()->route('shop.checkout.showShipping');
        } else {
            return redirect()->route('shop.cart.index');
        }
    }

    public function showShipping()
    {
        $order = $this->shopService->getActiveOrder();
        $order->calculateTax();

        if ($this->shopService->getActiveOrder()->item_count === 0) {
            return redirect()->route('shop.cart.index');
        }

        return view('shop.checkout.shipping', [
            'order' => $order,
            'shipment' => $order->default_shipment,
        ]);
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
            $request->input('first_name'),
            $request->input('last_name'),
            '',
            $request->input('email'),
            $request->input('phone'),
            $request->input('address1'),
            $request->input('address2'),
            $request->input('city'),
            $request->input('state'),
            $request->input('zip'),
            'US'
        );

        return redirect()->route('shop.checkout.showBilling');
    }

    public function showBilling(Request $request)
    {
        // just in case...
        $order = $this->shopService->getActiveOrder();
        $order->calculateTax();

        return view('shop.checkout.billing', [
            'stripePublishableKey' => config('wax.shop.payment.drivers.stripe.publishable_key'),
        ]);
    }

    public function pay(Request $request)
    {
        $order = $this->shopService->getActiveOrder();
        $order->calculateTax();
        $token = new TokenPaymentType();
        $token->loadData([
            'token' => $request->input('token'),
            'lastFour' => $request->input('last_four'),
        ]);

        $this->shopService->applyPayment(
            $token
        );

        return redirect()->route('shop.checkout.confirmation');
    }

    public function showConfirmation()
    {
        $order = $this->shopService->getPlacedOrder();

        if (! $order) {
            return redirect()->route('home');
        }

        return view('shop.checkout.confirmation', [
            'order' => $order,
        ]);
    }
}
