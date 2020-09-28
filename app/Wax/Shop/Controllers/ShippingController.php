<?php

namespace App\Wax\Shop\Controllers;

use App\Http\Controllers\Controller;
use App\Wax\Shop\Models\Order\ShippingRate;
use App\Wax\Shop\Services\ShippingService;
use Illuminate\Http\Request;
use Wax\Shop\Services\ShopService;

class ShippingController extends Controller
{
    protected ShopService $shopService;
    protected ShippingService $shippingService;

    public function __construct(
        ShopService $shopService,
        ShippingService $shippingService
    ) {
        $this->shopService = $shopService;
        $this->shippingService = $shippingService;
    }

    public function showShipping(Request $request)
    {
        $order = $this->shopService->getActiveOrder();
        $order->calculateTax();

        if (!$this->shopService->getActiveOrder()->validateHasItems()) {
            return redirect()->route('shop.cart.index');
        }

        return view('shop.checkout.shipping', [
            'order' => $order,
            'shipment' => $order->default_shipment,
            'inStorePickup' => $request->old('in_store_pickup')
        ]);
    }

    public function saveShipping(Request $request)
    {
        $shipment = $this->shopService->getActiveOrder()->default_shipment;

        $this->validate(
            $request,
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address1' => 'required',
                'city' => 'required',
                'state' => 'required|exists:tax,zone',
                'zip' => 'required',
            ],
            [
                'first_name.required' => ':attribute is required.',
                'last_name.required' => ':attribute is required.',
                'email.required' => ':attribute is required.',
                'phone.required' => ':attribute is required.',
                'address1.required' => ':attribute is required.',
                'city.required' => ':attribute is required.',
                'state.required' => ':attribute is required.',
                'state.exists' => 'State must be a valid uppercase, two-letter abbreviation.',
                'zip.required' => ':attribute is required.',
            ],
            [
                'first_name' => 'first name',
                'last_name' => 'last name',
                'address1' => 'address line 1',
            ],
        );

        if ($request->input('in_store_pickup')) {
            $shipment->in_store_pickup = true;
        } else {
            $shipment->in_store_pickup = false;
        }
        $shipment->save();

        $shipment->setAddress(
            $request->input('first_name'),
            $request->input('last_name'),
            '',
            $request->input('email'),
            $request->input('phone'),
            $request->input('address1', ''),
            $request->input('address2', ''),
            $request->input('city', ''),
            $request->input('state', ''),
            $request->input('zip', ''),
            'US'
        );

        return redirect()->route('shop.checkout.showRates');
    }

    public function showRates()
    {
        $order = $this->shopService->getActiveOrder();

        if (!$order->default_shipment->isAddressSet()) {
            return redirect()
                ->route('shop.checkout.showShipping')
                ->with('error', 'You must have a valid shipping address');
        }

        $rates = $this->shippingService->refreshRatesfor($order);

        return view('shop.checkout.rates', [
            'order' => $order,
            'rates' => $rates->sortBy('amount'),
            'defaultRate' => $order->default_shipment->shipping_service_name,
        ]);
    }

    public function saveRate(Request $request)
    {
        $order = $this->shopService->getActiveOrder();

        $rate = ShippingRate::where('shipment_id', $order->default_shipment->id)
            ->where('id', $request->input('rate_id'))
            ->first();

        if (!$rate) {
            return redirect()
                ->back()
                ->with('error', 'Shipping rate error. Please try again.');
        }

        $order->default_shipment->setShippingService($rate);

        return redirect()
            ->route('shop.checkout.showBilling');
    }
}
