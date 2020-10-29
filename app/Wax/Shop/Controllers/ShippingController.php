<?php

namespace App\Wax\Shop\Controllers;

use App\Http\Controllers\Controller;
use App\Wax\Shop\Models\Order\ShippingRate;
use App\Wax\Shop\Services\ShippingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Wax\Core\Eloquent\Models\User\Address;
use Wax\Core\Repositories\AddressBookRepository;
use Wax\Shop\Services\ShopService;

class ShippingController extends Controller
{
    protected ShopService $shopService;
    protected ShippingService $shippingService;
    protected AddressBookRepository $addressBookRepo;

    public function __construct(
        ShopService $shopService,
        ShippingService $shippingService,
        AddressBookRepository $addressBookRepo
    ) {
        $this->shopService = $shopService;
        $this->shippingService = $shippingService;
        $this->addressBookRepo = $addressBookRepo;
    }

    public function showShipping(Request $request)
    {
        $order = $this->shopService->getActiveOrder();
        $order->calculateTax();

        if (config('shipping.custom_shipping')) {
            $this->shippingService->refreshRatesfor($order);
        }

        if (!$this->shopService->getActiveOrder()->validateHasItems()) {
            return redirect()->route('shop.cart.index');
        }

        return view('shop.checkout.shipping', [
            'order' => $order,
            'shipment' => $order->default_shipment,
            'inStorePickup' => $request->old('in_store_pickup'),
            'addresses' => Auth::check() ? $this->addressBookRepo->getAll()->sortByDesc('default_shipping') : collect(),
        ]);
    }

    public function saveShipping(Request $request)
    {
        $order = $this->shopService->getActiveOrder();
        $shipment = $order->default_shipment;

        if ($request->input('in_store_pickup')) {
            $shipment->in_store_pickup = true;
        } else {
            $shipment->in_store_pickup = false;
        }
        $shipment->save();

        $address = null;

        if (Auth::check() && $request->input('address_id')) {
            $address = Address::where('user_id', Auth::user()->id)
                ->where('id', $request->input('address_id'))
                ->first();
        }

        if (! $address) {
            $this->validate(
                $request,
                [
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'email' => 'required',
                    'phone' => 'required',
                    'address1' => 'required',
                    'city' => 'required',
                    'state' => 'required|exists:tax,zone',
                    'zip' => 'required',
                ],
                [
                    'firstname.required' => ':attribute is required.',
                    'lastname.required' => ':attribute is required.',
                    'email.required' => ':attribute is required.',
                    'phone.required' => ':attribute is required.',
                    'address1.required' => ':attribute is required.',
                    'city.required' => ':attribute is required.',
                    'state.required' => ':attribute is required.',
                    'state.exists' => 'State must be a valid uppercase, two-letter abbreviation.',
                    'zip.required' => ':attribute is required.',
                ],
                [
                    'firstname' => 'first name',
                    'lastname' => 'last name',
                    'address1' => 'address line 1',
                ],
            );

            $data = [
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'company' => '',
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address1' => $request->input('address1', ''),
                'address2' => $request->input('address2', ''),
                'city' => $request->input('city', ''),
                'state' => $request->input('state', ''),
                'zip' => $request->input('zip', ''),
                'country' => 'US'
            ];

            if (Auth::check() && $request->input('save_address')) {
                $this->addressBookRepo->create($data);
            }

            $shipment->setAddress(...array_values($data));
        } else {
            $shipment->setAddress(
                $address->firstname,
                $address->lastname,
                $address->company ?? '',
                $address->email,
                $address->phone,
                $address->address1,
                $address->address2,
                $address->city,
                $address->state,
                $address->zip,
                $address->country
            );
        }

        if (config('shipping.custom_shipping')) {
            $this->shippingService->refreshRatesfor($order);
            return redirect()->route('shop.checkout.showBilling');
        }

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
