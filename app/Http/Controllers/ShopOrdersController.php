<?php

namespace App\Http\Controllers;

use App\Category;
use App\Models\EbayOrder;
use App\Models\Listing\Item as ListingItem;
use App\Wax\Shop\Models\Order;
use App\Wax\Shop\Models\Order\Item as OrderItem;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;
use Wax\Shop\Facades\ShopServiceFacade as ShopService;

class ShopOrdersController extends Controller
{
    public function index()
    {
        return view('dashboard.shop.orders.index', [
            'orders' => Order
                ::placed()
                ->orderBy('placed_at', 'desc')
                ->paginate(25)
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

                $order->shipped_at = Carbon::now()->toDateTimeString();
                $order->save();
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
            'eBay',
            'Listing SKU',
            'Item SKU',
            'Bin',
        ];

        $lineItems = Order::placed()
            ->notShipped()
            ->get()
            ->map(fn($order) => $order->items)
            ->flatten()
            ->map(fn($item) => $item->listingItems)
            ->flatten();

        $ebayLineItems = EbayOrder::forOrderProcessingReport()
            ->get()
            ->map(fn ($order) => $order->items)
            ->flatten();

        $callback = function () use ($lineItems, $columns, $ebayLineItems) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($lineItems as $lineItem) {
                fputcsv($file, [
                    $lineItem->listing->title,
                    $lineItem->orderItem->shipment->order->sequence,
                    'no',
                    $lineItem->listing_id,
                    $lineItem->id,
                    $lineItem->bin,
                ]);
            }

            foreach ($ebayLineItems as $lineItem) {
                fputcsv($file, [
                    $lineItem->listing->title,
                    $lineItem->ebayOrder->ebay_id,
                    'yes',
                    $lineItem->listing_id,
                    $lineItem->id,
                    $lineItem->bin,
                ]);
            }
        };

        return response()->stream($callback, 200, $headers);
    }

    public function salesByCategory(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'from' => [
                    Rule::requiredIf($request->input('to')),
                    'date'
                ],
                'to' => 'date|after_or_equal:' . $request->input('from') . '|before:tomorrow',
            ]
        );

        $doDateFiltering = $validator->passes()
            && $request->input('to')
            && $request->input('from');

        $categories = DB::table('orders')
            ->selectRaw('product_categories.name, product_categories.id, product_categories.parent_id, sum(order_items.quantity) as quantity_sold, sum(order_items.quantity * order_items.price) as dollars_sold')
            ->join('order_shipments', 'order_shipments.order_id', '=', 'orders.id')
            ->join('order_items', 'order_items.shipment_id', '=', 'order_shipments.id')
            ->join('order_item_customizations', function ($join) {
                $join->on('order_item_customizations.item_id', '=', 'order_items.id')
                    ->where('customization_id', 1);
            })
            ->join('listings', 'listings.id', '=', 'order_item_customizations.value')
            ->join('ad_category_links', 'listings.id', '=', 'ad_category_links.ad_id')
            ->join('product_categories', 'ad_category_links.category_id', '=', 'product_categories.id')
            ->whereNotNull('placed_at')
            ->groupBy('name', 'id', 'parent_id')
            ->when($doDateFiltering, function ($query) use ($request) {
                $query->where('placed_at', '>=', $request->input('from'))
                    ->where('placed_at', '<=', $request->input('to') . ' 23:59:59');
            })
            ->get();


        return view('dashboard.category-sales-report', [
            'categories' => $categories,
            'errors' => $validator->errors(),
            'to' => $request->input('to'),
            'from' => $request->input('from'),
        ]);

        /*
            select product_categories.name, product_categories.id, product_categories.parent_id, sum(order_items.quantity) as quantity_sold, sum(order_items.quantity * order_items.price) as dollars_sold
            from orders
                inner join order_shipments ON order_shipments.order_id = orders.id
                inner join order_items ON order_items.shipment_id = order_shipments.`id`
                inner join order_item_customizations ON order_item_customizations.item_id = order_items.id AND customization_id = 1
                inner join listings ON listings.id = order_item_customizations.value
                inner join `ad_category_links` on listings.id = ad_category_links.`ad_id`
                inner join product_categories on ad_category_links.`category_id` = product_categories.id
            where placed_at is not null
            group by name, id, parent_id
            order by name
        */
    }
}
