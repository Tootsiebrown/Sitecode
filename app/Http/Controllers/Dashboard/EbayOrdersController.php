<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\EbayOrder;

class EbayOrdersController extends Controller
{
    public function index()
    {
        $orders = EbayOrder::orderBy('created_at', 'desc')
            ->paginate();

        return view(
            'dashboard.ebay.orders.index',
            ['orders' => $orders]
        );
    }

    public function show($id)
    {
        return view(
            'dashboard.ebay.orders.details',
            ['order' => EbayOrder::findorFail($id)]
        );
    }



    public function cancel($id)
    {
        $order = EbayOrder::find($id);

        if (!$order) {
            abort(404);
        }

        $order->cancel();

        return redirect()
            ->back()
            ->with('success', 'Order canceled.');
    }
}
