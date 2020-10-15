<?php

namespace App\Http\Controllers;

use App\Models\Listing;

class AuctionsController extends Controller
{
    public function index()
    {
        return view('dashboard.auctions.index', [
            'listings' => Listing::withoutGlobalScopes()
                ->typeIsAuction()
                ->with('bids')
                ->orderBy('expired_at', 'desc')
                ->paginate()
        ]);
    }

    public function details($listingId)
    {
        $listing = Listing::findOrFail($listingId);

        return view('dashboard.shop.orders.details', [
            'listing' => $listing,
        ]);
    }
}
