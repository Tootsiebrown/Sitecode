<?php

namespace App\Http\Controllers;

use App\Wax\Shop\Models\Order;

class DashboardOrdersController extends Controller
{
    public function index()
    {
        return view('dashboard.orders.index', [
            'orders' => Order::mine()
                ->placed()
                ->orderBy('placed_at', 'desc')
                ->paginate()
        ]);
    }

    public function details($orderId)
    {
        $order = Order::mine()->placed()->where('id', $orderId)->first();

        if (!$order) {
            abort(404);
        }

        return view('dashboard.orders.details', [
            'order' => $order,
        ]);
    }
}
