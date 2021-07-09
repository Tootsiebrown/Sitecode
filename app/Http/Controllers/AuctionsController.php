<?php

namespace App\Http\Controllers;

use App\Bid;
use Carbon\Carbon;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuctionsController extends Controller
{
    public function index()
    {
        return view('dashboard.auctions.index');
    }

    public function details($listingId)
    {
        $listing = Listing::findOrFail($listingId);

        return view('dashboard.shop.orders.details', [
            'listing' => $listing,
        ]);
    }
    public function ajaxSearch(Request $request)
    {
        $columns = [
            'title',
            'expired_at',
            'bids',
            'bids_history',
            'purchased',
            'created_at',
        ];
        $totalData = Listing::withoutGlobalScopes()
            ->typeIsAuction()
            ->count();

        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $from = $request->input('from');
        $to = $request->input('to');
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $listings = $this->sortAndFilterRecords($search, $start, $limit, $from, $to, $order, $dir);
        $totalFiltered = $this->totalFilteredRecords($search, $from, $to);
        $data = $this->populateRecords($listings);

        $json_data = [
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        ];

        return response()->json($json_data);
    }

    private function sortAndFilterRecords($search, $start, $limit, $from, $to, $order, $dir)
    {
        $query  = DB::table('listings')
            ->where('type', 'auction')
            ->leftJoin('listing_items', 'listings.id', '=', 'listing_items.listing_id')
            ->leftJoin('bids', 'listings.id', '=', 'bids.listing_id')
            ->select(
                [
                    'listings.id', 'listings.title', 'listings.slug', 'listings.expired_at', 'listings.created_at', 'listing_items.order_item_id as purchased',
                    DB::raw("count(bids.listing_id) as bids")
                ]
            );
        if (!empty($search)) {
            $query  = $query->Where('title', 'LIKE', "%{$search}%");
        }
        if (!empty($from) && !empty($to)) {
            $query  = $query->whereBetween('listings.created_at', [Carbon::parse($from)->startOfDay()->toDateTimeString(), Carbon::parse($to)->endOfDay()->toDateTimeString()]);
        }
        $result = $query->offset($start)
            ->limit($limit)
            ->groupBy(
                [
                    'listings.id', 'listings.title', 'listings.slug', 'listings.expired_at', 'listing_items.order_item_id', 'listings.id'
                ]
            )
            ->orderBy($order, $dir)
            ->get();
        return $result;
    }
    private function totalFilteredRecords($search, $from, $to)
    {
        $query = DB::table('listings')
            ->select(['listings.id'])
            ->where('type', 'auction');
        if (!empty($search)) {
            $query  = $query->Where('title', 'LIKE', "%{$search}%");
        }
        if (!empty($from) && !empty($to)) {
            $query  = $query->whereBetween('listings.created_at', [Carbon::parse($from)->format("Y-m-d"), Carbon::parse($to)->format("Y-m-d")]);
        }
        $result = $query->count();
        return $result;
    }
    private function populateRecords($listings)
    {
        $data = [];
        if (!empty($listings)) {
            foreach ($listings as $listing) {
                $nestedData['listing'] = "<a href='{$this->url($listing)['single']}'> {$listing->title}</a>";
                $nestedData['expires_at'] = Carbon::parse($listing->expired_at)->format('Y-m-d H:i');
                $nestedData['bids'] = $listing->bids;
                $nestedData['bids_history'] = "<a href='{$this->url($listing)['bid-history']}'> View </a>";
                $nestedData['purchased'] =  $listing->purchased ? 'Yes' : 'No';
                $nestedData['created_at'] = Carbon::parse($listing->created_at)->format('Y-m-d');

                $data[] = $nestedData;
            }
        }
        return $data;
    }
    private function url($listing): array
    {
        $urls = [];
        $urls['single'] = route('singleListing', [
            'id' => $listing->id,
            'slug' => $listing->slug,
        ]);
        $urls['bid-history'] = route('dashboard.auctions.bid-history', [
            'listing_id' => $listing->id,
        ]);
        return $urls;
    }

    public function getBidsHistory($listing_id)
    {
        $bids = Bid::with('user')->where('listing_id', $listing_id)->orderBy('updated_at', 'desc')->get();
        $currentWinningBid = $bids->sortByDesc('bid_amount')->first();

        return view('dashboard.auctions.bids-history', compact('bids', 'currentWinningBid'));
    }
}
