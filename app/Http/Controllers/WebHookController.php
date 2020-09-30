<?php

namespace App\Http\Controllers;

use App\Jobs\SyncShipmentShipped;
use Illuminate\Http\Request;

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
}
