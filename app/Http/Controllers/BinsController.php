<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class BinsController extends Controller
{
    public function showListingBins($listingId)
    {
        $listing = Listing::with(['items'])
            ->findOrFail($listingId);

        return view('dashboard.bins.listing', ['listing' => $listing]);
    }

    public function saveListingBins(Request $request, $listingId)
    {
        $this->validate(
            $request,
            [
                'bin.*' => 'max:255',
            ]
        );

        $listing = $listing = Listing::with(['items'])
            ->findOrFail($listingId);

        $listing->items->each(function($item) {
            $item->bin = request('bin.' . $item->id);
            $item->save();
        });

        return redirect()
            ->route('dashboard.bins.showListingBins', ['id' => $listing->id])
            ->with('success', 'Bins Edited.');
    }
}
