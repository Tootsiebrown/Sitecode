<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Listing\Item;
use Illuminate\Http\Request;

class BinsController extends Controller
{
    public function index(Request $request)
    {
        $listingSku = $request->input('listing_sku');
        $itemSku = $request->input('item_sku');
        $searchBy = $request->input('search_by');

        $message = null;

        if ($searchBy) {
            switch ($searchBy) {
                case 'listing_sku':
                    $listing = Listing::find($listingSku);
                    if ($listing) {
                        return redirect()->route('dashboard.bins.showListingBins', ['id' => $listing->id]);
                    }

                    $message = 'Could not find a listing with that SKU.';
                    break;
                case 'item_sku':
                    $item = Item::find($itemSku);
                    if ($item) {
                        return redirect()->route('dashboard.bins.showItemBin', ['id' => $item->id]);
                    }
                    $message = 'Could not find an item with that SKU';
                    break;
                default:
                    $message = 'Error: search method not implemented.';
            }
        }

        return view('dashboard.bins.index', [
            'itemSku' => $itemSku,
            'listingSku' => $listingSku,
            'message' => $message,
        ]);
    }

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

        $listing = Listing::with(['items'])
            ->findOrFail($listingId);

        $listing->items->each(function ($item) {
            $item->bin = request('bin.' . $item->id);
            $item->save();
        });

        return redirect()
            ->route('dashboard.bins.index')
            ->with('success', 'Bins Edited.');
    }

    public function showItemBin($id)
    {
        $item = Item::with(['listing'])
            ->findOrFail($id);

        return view('dashboard.bins.item', ['item' => $item]);
    }

    public function saveItemBin(Request $request, $itemId)
    {
        $this->validate(
            $request,
            [
                'bin' => 'max:255',
            ]
        );

        $item = Item::findOrFail($itemId);

        $item->bin = request('bin');
        $item->save();

        return redirect()
            ->route('dashboard.bins.index')
            ->with('success', 'Bin Edited.');
    }

    public function bulkEditListingBins(Request $request)
    {
        $this->validate(
            $request,
            [
                'listing_bulk_bin' => 'required|max:255',
            ]
        );

        $listing = Listing::with(['items'])
            ->findOrFail($request->input('listing_id'));

        Item::where('listing_id', $listing->id)
            ->update(['bin' => $request->input('listing_bulk_bin')]);

        return redirect()
            ->route('dashboard.bins.index')
            ->with('success', 'Bins Edited.');
    }
}