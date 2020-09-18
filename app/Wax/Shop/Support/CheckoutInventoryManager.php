<?php

namespace App\Wax\Shop\Support;

use App\Wax\Shop\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CheckoutInventoryManager
{
    public function reserveItems(Order $order)
    {
        $order
            ->default_shipment
            ->items
            ->each(function ($item) use ($order) {
                $numberOfRowsAffected = DB::table('listing_items')
                    ->where('listing_id', $item->listing_id)
                    ->whereNull('order_item_id')
                    ->whereNull('reserved_for_order_id')
                    ->limit($item->quantity)
                    ->update(['reserved_for_order_id' => $order->id]);

                if ($numberOfRowsAffected < $item->quantity) {
                    throw ValidationException::withMessages(['payment' => 'Insufficient Inventory for ' . $item->name]);
                }
            });
    }

    public function releaseItems($order)
    {
        DB::table('listing_items')
            ->where('reserved_for_order_id', $order->id)
            ->update(['reserved_for_order_id' => null]);
    }

    public function markItemsSold(Order $order)
    {
        $order
            ->default_shipment
            ->items
            ->each(function ($item) use ($order) {
                DB::table('listing_items')
                    ->where('listing_id', $item->listing_id)
                    ->whereNull('order_item_id')
                    ->where('reserved_for_order_id', $order->id)
                    ->limit($item->quantity)
                    ->update(['order_item_id' => $item->id]);
            });
    }
}
