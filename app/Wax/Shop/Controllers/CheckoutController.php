<?php

namespace App\Wax\Shop\Controllers;

use App\Http\Controllers\Controller;
use App\Wax\Shop\Models\Order;
use App\Wax\Shop\Payment\Types\TokenPaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
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

    public function showShipping(Request $request)
    {
        $order = $this->shopService->getActiveOrder();
        $order->calculateTax();

        if (! $this->shopService->getActiveOrder()->validateHasItems()) {
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
                'address1' => 'required_unless:in_store_pickup,1',
                'city' => 'required_unless:in_store_pickup,1',
                'state' => 'required_unless:in_store_pickup,1',
                'zip' => 'required_unless:in_store_pickup,1',
            ],
            [
                'first_name.required' => ':attribute is required.',
                'last_name.required' => ':attribute is required.',
                'email.required' => ':attribute is required.',
                'phone.required' => ':attribute is required.',
                'address1.required_unless' => ':attribute is required.',
                'city.required_unless' => ':attribute is required.',
                'state.required_unless' => ':attribute is required.',
                'zip.required_unless' => ':attribute is required.',
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

        return redirect()->route('shop.checkout.showBilling');
    }

    public function showBilling(Request $request)
    {
        $order = $this->shopService->getActiveOrder();

        if (! $order->validateShipping()) {
            return redirect()->route('shop.checkout.showShipping');
        }

        // just in case...
        $order->calculateTax();

        return view('shop.checkout.billing', [
            'stripePublishableKey' => config('wax.shop.payment.drivers.stripe.publishable_key'),
            'shipment' => $order->default_shipment,
        ]);
    }

    public function pay(Request $request)
    {
        $this->validate(
            $request,
            [
                'first_name' => 'required_unless:same_as_shipping,1',
                'last_name' => 'required_unless:same_as_shipping,1',
                'email' => 'required_unless:same_as_shipping,1',
                'phone' => 'required_unless:same_as_shipping,1',
                'address1' => 'required_unless:same_as_shipping,1',
                'city' => 'required_unless:same_as_shipping,1',
                'state' => 'required_unless:same_as_shipping,1',
            ],
            [
                'first_name.required_unless' => ':attribute is required.',
                'last_name.required_unless' => ':attribute is required.',
                'email.required_unless' => ':attribute is required.',
                'phone.required_unless' => ':attribute is required.',
                'address1.required_unless' => ':attribute is required.',
                'city.required_unless' => ':attribute is required.',
                'state.required_unless' => ':attribute is required.',
            ],
            [
                'first_name' => 'first name',
                'last_name' => 'last name',
                'address1' => 'address line 1',
            ],
        );

        $order = $this->shopService->getActiveOrder();
        $order->calculateTax();
        $token = new TokenPaymentType();

        $token->loadData([
            'token' => $request->input('token'),
            'lastFour' => $request->input('last_four'),
            'zip' => $request->input('zip'),
            'brand' => $request->input('brand'),
            'address' => $this->getBillingAddress($request, $order),
        ]);



        DB::transaction(function () use ($order, $token) {
            $this->reserveItems($order);
            $this->shopService->applyPayment(
                $token
            );

            $order->refresh();

            $this->markItemsSold($order);
        });


        return redirect()->route('shop.checkout.confirmation');
    }

    protected function reserveItems(Order $order)
    {
        $order
            ->default_shipment
            ->items
            ->each(function ($item) {
                $result = DB::table('listing_items')
                    ->where('listing_id', $item->listing_id)
                    ->limit($item->quantity)
                    ->lockForUpdate()
                    ->get();

                if ($result->count() < $item->quantity) {
                    throw ValidationException::withMessages(['payment' => 'Insufficient Inventory for ' . $item->name]);
                }
            });
    }

    protected function markItemsSold(Order $order)
    {
        $order
            ->default_shipment
            ->items
            ->each(function ($item) {
                DB::table('listing_items')
                    ->where('listing_id', $item->listing_id)
                    ->limit($item->quantity)
                    ->update(['order_item_id' => $item->id]);
            });
    }

    protected function getBillingAddress(Request $request, Order $order)
    {
        if ($request->input('same_as_shipping')) {
            return [
                'firstname' => $order->default_shipment->firstname,
                'lastname' => $order->default_shipment->lastname,
                'address1' => $order->default_shipment->address1,
                'address2' => $order->default_shipment->address2,
                'city' => $order->default_shipment->city,
                'state' => $order->default_shipment->state,
                'country' => 'US'
            ];
        } else {
            return [
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'address1' => $request->input('address1'),
                'address2' => $request->input('address2'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'country' => 'US'
            ];
        }
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
