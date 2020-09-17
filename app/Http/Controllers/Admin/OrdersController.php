<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Wax\Shop\Facades\ShopServiceFacade as ShopService;

class OrdersController extends \Wax\Shop\Http\Controllers\Admin\OrdersController
{
    public function markProcessed(Request $request, $orderId)
    {
        $order = ShopService::getOrderById($orderId);

        $page = [
            'title' => "Order Details",
        ];

        if (ShopService::processOrder($order)) {
            $errors = ['The order has beem marked as processed'];
        } else {
            $errors = ['There was an error marking the order as processed'];
        }

        return view('shop::pages.admin.order-details', [
            'order' => $order, // note: not using toArray() because visibility is dialed in for front-end use.
            'page' => $page,
            'structure' => 'orders',
            'id' => $orderId,
            'errors' => ['The shipment has been marked as processed.'],
            'notes' => [],
        ]);
    }
}
