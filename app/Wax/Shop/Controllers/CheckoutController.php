<?php


namespace App\Wax\Shop\Controllers;


use App\Http\Controllers\Controller;
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
        if ($this->shopService->)
        return view('shop::pages.checkout');
    }

    public function showShippingForm()
    {

    }
}
