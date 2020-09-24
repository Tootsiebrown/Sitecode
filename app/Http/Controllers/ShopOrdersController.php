<?php

namespace App\Http\Controllers;

use App\Models\Listing\Item as ListingItem;
use App\Wax\Shop\Models\Order;
use Illuminate\Http\Request;
use Wax\Shop\Facades\ShopServiceFacade as ShopService;

class ShopOrdersController extends Controller
{
    public function index()
    {
        return view('dashboard.shop.orders.index', [
            'orders' => Order
                ::placed()
                ->orderBy('placed_at', 'desc')
                ->paginate()
        ]);
    }

    public function details($orderId)
    {
        $order = ShopService::getOrderById($orderId);

        if (!$order) {
            abort(404);
        }

        return view('dashboard.shop.orders.details', [
            'order' => $order,
        ]);
    }

    public function toggleItemRemoved(Request $request, $orderId, $listingItemId)
    {
        $item = ListingItem::where('id', $listingItemId)
            ->where('reserved_for_order_id', $orderId)
            ->first();

        if (!$item) {
            abort(404);
        }

        if ($item->removed == (bool)$request->input('current_status')) {
            $item->toggleRemoved();
        }

        return redirect()
            ->back()
            ->with('success', 'Item status toggled');
    }
}
