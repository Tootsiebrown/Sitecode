<?php

namespace App\Http\Controllers;

use App\Jobs\Ebay\SyncPendingTransaction;
use App\Jobs\Ebay\SyncOrder;
use App\Jobs\SyncShipmentShipped;
use App\Models\Listing;
use DOMDocument;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Wax\System;

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

        $listing = Listing::withoutGlobalScopes()
            ->findOrFail($listingId);

        $availableCount = $listing->availableItems()->count();

        return [
            'isAvailable' => $availableCount >= $quantity,
            'lastUpdated' => time(),
            'totalAvailableQuantity' => $availableCount,
        ];
    }

    public function ebayCheckoutComplete(Request $request)
    {
        return $this->ebayNotification($request);
    }

    public function ebayNotification(Request $request)
    {
        [
            $orderId,
            $transactionId,
            $paid,
            $sku,
            $quantity
        ] = $this->parseEbayNotification($request);

        // order hasn't been paid for yet
        if (! $paid) {
            if (!$sku) {
                throw new Exception('No sku for this pending transaction');
            }

            SyncPendingTransaction::dispatch(
                $transactionId,
                $sku,
                (int) $quantity,
            );

            return 'early exit';
        }

        if (! $orderId) {
            $this->log('order-less auction-complete call');
            System::logSystemAlert('order-less auction-complete call at about this timestamp');

            return 'early exit';
        }

        SyncOrder::dispatch($orderId, $transactionId)->onQueue('fast');

        return 'success';
    }

    protected function parseEbayNotification(Request $request)
    {
        $dom = new DOMDocument();
        if (config('services.ebay.log.auction_complete_webhook')) {
            $this->log($request->getContent());
        }
        $dom->loadXML($request->getContent());
        $orderIdNodes = $dom->getElementsByTagName('OrderID');
        $orderId = $orderIdNodes->item(0)->textContent;

        $transactionIdNodes = $dom->getElementsByTagName('TransactionID');
        $transactionId = $transactionIdNodes->item(0)->textContent;

        $paidTimeElements = $dom->getElementsByTagName('PaidTime');
        $paidTime = $paidTimeElements->item(0);

        $skuNodes = $dom->getElementsByTagName('SKU');
        $quantityNodes = $dom->getElementsByTagName('QuantityPurchased');

        return [
            $orderId,
            $transactionId,
            $paidTime ? true : false,
            $skuNodes->length === 0 ? null : $skuNodes->item(0)->textContent,
            $quantityNodes->length === 0 ? null : $quantityNodes->item(0)->textContent,
        ];
    }

    public function log($message)
    {
        Log::channel('single')->info($message);
    }
}
