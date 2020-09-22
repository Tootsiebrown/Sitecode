<?php

namespace App\Http\Controllers;

use App\Models\Listing;

class AuctionActivityController extends Controller
{
    public function index()
    {
        return view('dashboard.auction-activity.index', [
            'listings' => Listing::withoutGlobalScopes()->thatIBidFor()->orderBy('expired_at', 'desc')->paginate(10),
        ]);
    }
}
