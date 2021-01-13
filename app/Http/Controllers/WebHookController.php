<?php

namespace App\Http\Controllers;

use App\Ebay\Sdk;
use App\Jobs\SyncEbayTransaction;
use App\Jobs\SyncShipmentShipped;
use App\Models\Listing;
use Carbon\Carbon;
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
            return;
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
        \Log::info($request->getContent());
        $dom->loadXML($request->getContent());
        $elements = $dom->getElementsByTagName('TransactionID');
        $transactionId = $elements->item(0)->textContent;

        if ($transactionId) {
            SyncEbayTransaction::dispatch($transactionId)->onQueue('fast');
        }
    }
}
