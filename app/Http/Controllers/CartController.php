<?php

namespace App\Http\Controllers;

use Wax\Shop\Repositories\OrderRepository;
use Wax\Shop\Services\ShopService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $shopService;
    protected $orderRepo;

    public function __construct(ShopService $shopService, OrderRepository $orderRepo)
    {
        $this->shopService = $shopService;
        $this->orderRepo = $orderRepo;
    }

    public function index()
    {
        // This isn't necessary but it helps for debugging the math
        $this->orderRepo
            ->getActive()
            ->calculateDiscounts();

        $this->orderRepo
            ->getActive()
            ->default_shipment
            ->combineDuplicateItems();

        return view('shop.cart.index', ['order' => $this->shopService->getActiveOrder()]);
    }

    public function store(Request $request)
    {
        $this->shopService->addOrderItem(
            $request->input('product_id'),
            $request->input('quantity'),
            $request->input('options', []),
            $request->input('customizations', [])
        );

        return redirect()
            ->back()
            ->with('success', 'Item added to cart');
    }

    public function destroy($itemId)
    {
        $this->shopService->deleteOrderItem($itemId);

        return redirect()
            ->back()
            ->with('success', 'Item deleted from cart');
    }
}
