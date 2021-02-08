<?php

namespace App\Wax\Shop\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\User;
use App\Wax\Shop\Models\Order;
use App\Wax\Shop\Payment\Types\TokenPaymentType;
use App\Wax\Shop\Support\CheckoutInventoryManager;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Illuminate\Http\Request;
use Wax\Shop\Exceptions\ValidationException;
use Wax\Shop\Models\User\PaymentMethod;
use Wax\Shop\Payment\Repositories\PaymentMethodRepository;
use Wax\Shop\Payment\Validators\OrderPaymentParser;
use Wax\Shop\Services\ShopService;

class CheckoutController extends Controller
{
    /** @var ShopService */
    protected $shopService;

    /** @var CheckoutInventoryManager */
    protected $inventoryManager;

    /** @var PaymentMethodRepository */
    protected PaymentMethodRepository $paymentMethodRepo;

    public function __construct(
        ShopService $shopService,
        CheckoutInventoryManager $inventoryManager,
        PaymentMethodRepository $paymentMethodRepo
    ) {
        $this->shopService = $shopService;
        $this->inventoryManager = $inventoryManager;
        $this->paymentMethodRepo = $paymentMethodRepo;
    }

    public function checkout()
    {
        if ($this->shopService->getActiveOrder()->item_count > 0) {
            return redirect()->route('shop.checkout.showShipping');
        } else {
            return redirect()->route('shop.cart.index');
        }
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
            'paymentMethods' => Auth::check() ? $this->paymentMethodRepo->getAll() : collect(),
        ]);
    }

    public function pay(Request $request)
    {
        if (! $request->has('payment_method_id')) {
            $rules = [
                'first_name' => 'required_unless:same_as_shipping,1',
                'last_name' => 'required_unless:same_as_shipping,1',
                'email' => 'required_unless:same_as_shipping,1|email:rfc,filter,dns',
                'phone' => 'required_unless:same_as_shipping,1',
                'address1' => 'required_unless:same_as_shipping,1',
                'city' => 'required_unless:same_as_shipping,1',
                'state' => 'required_unless:same_as_shipping,1',
            ];

            if ($this->mustAcceptTerms()) {
                $rules['terms_and_conditions'] = 'required|accepted';
            }

            $this->validate(
                $request,
                $rules,
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
        }

        if (Auth::check()) {
            $user = Auth::user();
            if (is_null($user->accepted_terms_at)) {
                $user->accepted_terms_at = Carbon::now()->toDateTimeString();
                $user->save();
            }
        }

        $order = $this->shopService->getActiveOrder();
        $order->calculateTax();


        $tokenData = [
            'token' => $request->input('token'),
            'lastFour' => $request->input('last_four'),
            'zip' => $request->input('zip'),
            'brand' => $request->input('brand'),
            'address' => $this->getBillingAddress($request, $order),
        ];

        try {
            $this->inventoryManager->reserveItems($order);
        } catch (Throwable $e) {
            $this->inventoryManager->releaseItems($order);

            throw $e;
        }

        try {
            if (
                Auth::check()
                && $request->has('payment_method_id')
                && $request->input('payment_method_id') !== 'new'
            ) {
                $paymentMethod = PaymentMethod::where('user_id', Auth::user()->id)
                    ->where('id', $request->input('payment_method_id'))
                    ->firstOrFail();

                $payment = $this->paymentMethodRepo->makePayment($order, $paymentMethod);
                if ($payment) {
                    (new OrderPaymentParser($payment))->validate();
                    $order->place();
                }
            } elseif (Auth::check() && $request->input('save_billing')) {
                if (is_null(Auth::user()->payment_profile_id)) {
                    $this->createPaymentProfile(Auth::user());
                }

                $tokenData['customerReference'] = Auth::user()->payment_profile_id;
                $paymentMethod = $this->paymentMethodRepo->create($tokenData);
                $payment = $this->paymentMethodRepo->makePayment($order, $paymentMethod);
                if ($payment) {
                    (new OrderPaymentParser($payment))->validate();
                    $order->place();
                }
            } else {
                $token = new TokenPaymentType();
                $token->loadData($tokenData);
                $payment = $this->shopService->applyPayment(
                    $token
                );
            }
        } catch (Throwable $e) {
            $this->inventoryManager->releaseItems($order);

            throw $e;
        }

        if (! $payment) {
            $this->inventoryManager->releaseItems($order);
            throw ValidationException::withMessages(['general' => 'There was an error paying for your order']);
        }

        $order->refresh();

        $this->inventoryManager->markItemsSold($order);

        return redirect()->route('shop.checkout.confirmation');
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
            'googleAnalyticsDataLayer' => $this->getGoogleAnalyticsDataLayerForOrder($order),
            'order' => $order,
        ]);
    }

    protected function getGoogleAnalyticsDataLayerForOrder(Order $order): array
    {
        $data = [
            'actionField' => [
                'id' => $order->sequence,
                'affiliation' => 'catchndealz.com',
                'revenue' => $order->total,
                'tax' => $order->tax_subtotal,
                'shipping' => $order->shipping_subtotal,
            ],
            'products' => []
        ];

        if ($order->coupon) {
            $data['actionField']['coupon'] = $order->coupon->code;
        }

        foreach ($order->items as $item) {
            $data['products'][] = [
                'name' => $item->name,
                'id' => $item->listing_id,
                'category' => $item->listing->google_analytics_category,
                'price' => $item->price,
                'quantity' => $item->quantity,
            ];
        }

        return $data;
    }

    protected function createPaymentProfile(User $user)
    {
        $stripe = app()->make(config('wax.shop.payment.stored_payment_driver'))->setUser($user);

        $profileId = $stripe->createProfile();

        $user->payment_profile_id = $profileId;
        $user->save();
    }

    protected function mustAcceptTerms()
    {
        return !Auth::check()
            || (Auth::check() && is_null(Auth::user()->accepted_terms_at));
    }
}
