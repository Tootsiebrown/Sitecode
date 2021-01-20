<?php

namespace App\Http\Controllers;

use App\Jobs\SyncEbayOrder;
use App\Jobs\SyncShipmentShipped;
use App\Models\Listing;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class WebHookController extends Controller
{
    public function orderShipped(Request $request)
    {
        $url = $request->input('resource_url');
        $query = parse_url($url, PHP_URL_QUERY);
        parse_str($query, $vars);

        if (
            $vars['storeID'] != config('services.ship_station.store_id')
            || $request->input('resource_type') !== 'SHIP_NOTIFY'
        ) {
            return true;
        }

        SyncShipmentShipped::dispatch($vars);

        return 'success';
    }

    public function ebayInventoryCheck(Request $request)
    {
        $listingId = $request->input('SKU');
        $quantity = $request->input('requestedQuantity');

        $environment = App::environment();

        if ($environment !== 'production') {
            $listingId = substr($listingId, strlen($environment) + 1);
        } else {
            $listingId = substr($listingId, strlen('website') + 1);
        }

        $listing = Listing::findOrFail($listingId);
        $availableCount = $listing->availableItems()->count();

        return [
            'isAvailable' => $availableCount >= $quantity,
            'lastUpdated' => time(),
            'totalAvailableQuantity' => $availableCount,
        ];
    }

    public function ebayCheckoutComplete(Request $request)
    {
        $dom = new DOMDocument();
        if (config('services.ebay.log.auction_complete_webhook')) {
            Log::channel('single')->info($request->getContent());
        }
        $dom->loadXML($request->getContent());
        $elements = $dom->getElementsByTagName('OrderID');
        $orderId = $elements->item(0)->textContent;

        if ($orderId) {
            SyncEbayOrder::dispatch($orderId)->onQueue('fast');
        }
    }
}
