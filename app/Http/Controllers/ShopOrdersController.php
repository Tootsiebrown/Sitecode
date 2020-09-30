<?php

namespace App\Http\Controllers;

use App\Models\Listing\Item as ListingItem;
use App\Wax\Shop\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
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

    public function setStatus(Request $request, $id)
    {
        $order = Order::placed()->find($id);

        if (!$order || !$order->placed_at) {
            abort(404);
        }

        switch ($request->input('status')) {
            case 'processed':
                $allRemovedFromBin = $order
                    ->items
                    ->map(function ($item) {
                        return $item->listingItems;
                    })
                    ->flatten()
                    ->filter(function ($item) {
                        return is_null($item->removed_at);
                    })
                    ->count() == 0;

                if (!$allRemovedFromBin) {
                    return redirect()
                        ->back()
                        ->with('error', 'All items must be removed from their respective bins before an order can be marked as processed.');
                }

                $order->processed_at = Carbon::now()->toDateTimeString();
                $order->save();
                break;

            case 'shipped':
                if (!$order->processed_at) {
                    return redirect()
                        ->back()
                        ->with('error', 'Order must be processed to be marked as shipped.');
                }

                $order->default_shipment->shipped_at = Carbon::now()->toDateTimeString();
                $order->default_shipment->save();
                break;

            default:
                throw new Exception('Unrecognized order status: ' . $request->input('status'));
        }

        return redirect()
            ->back()
            ->with('success', 'Order status updated.');
    }

    public function cancel($id)
    {
        $order = Order::placed()->find($id);

        if (!$order) {
            abort(404);
        }

        $order->cancel();

        return redirect()
            ->back()
            ->with('success', 'Order canceled.');
    }

    public function report()
    {
        $fileName = 'orders-' . date('Y-m-d-H-i-s') . '.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = [
            'Listing Title',
            'Order Number',
            'Listing SKU',
            'Item SKU',
            'Bin'
        ];

        $lineItems = Order::placed()
            ->notShipped()
            ->get()
            ->map(fn($order) => $order->items)
            ->flatten()
            ->map(fn($item) => $item->listingItems)
            ->flatten();

        $callback = function () use ($lineItems, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($lineItems as $lineItem) {
                fputcsv($file, [
                    $lineItem->listing->title,
                    $lineItem->orderItem->shipment->order->sequence,
                    $lineItem->listing_id,
                    $lineItem->id,
                    $lineItem->bin,
                ]);
            }
        };

        return response()->stream($callback, 200, $headers);
    }
}
