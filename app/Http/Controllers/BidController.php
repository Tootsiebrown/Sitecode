<?php

namespace App\Http\Controllers;

use App\Bid;
use App\Events\BidReceivedEvent;
use App\Models\Listing;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function index($ad_id)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $ad = Listing::find($ad_id);

        $title = trans('app.bids_for') . ' ' . $ad->title;

        if (! $user->isAdmin()) {
            if ($ad->user_id != $user_id) {
                return view('dashboard.error.error_404');
            }
        }
        return view('dashboard.bids', compact('title', 'ad'));
    }

    public function postBid(Request $request, $listingId)
    {
        if (! Auth::check()) {
            return redirect(route('login'))->with('error', trans('app.login_first_to_post_bid'));
        }

        $bid_amount = $request->bid_amount;

        $listing = Listing::find($listingId);
        if (! $listing) {
            abort(404);
        }

        $rules = [
            'bid_amount' => 'required|gte:' . (string)($listing->current_bid() + 1),
        ];
        $this->validate($request, $rules);


        $bid = Bid::create([
            'listing_id'         => $listingId,
            'user_id'       => Auth::user()->id,
            'bid_amount'    => $bid_amount,
            'is_accepted'   => 0,
        ]);

        event(new BidReceivedEvent($bid));

        return back()->with('success', trans('app.your_bid_posted'));
    }

    public function bidAction(Request $request)
    {
        $action = $request->action;
        $ad_id = $request->ad_id;
        $bid_id = $request->bid_id;

        $user = Auth::user();
        $user_id = $user->id;
        $ad = Listing::find($ad_id);

        if (! $user->isAdmin()) {
            if ($ad->user_id != $user_id) {
                return ['success' => 0];
            }
        }

        $bid = Bid::find($bid_id);
        switch ($action) {
            case 'accept':
                $bid->is_accepted = 1;
                $bid->save();
                break;
            case 'delete':
                $bid->delete();
                break;
        }
        return ['success' => 1];
    }

    public function bidderInfo($bid_id)
    {
        $bid = Bid::find($bid_id);
        $title = trans('app.bidder_info');

        $auth_user = Auth::user();
        $user_id = $auth_user->id;
        $ad = Listing::find($bid->ad_id);

        if (! $auth_user->isAdmin()) {
            if ($ad->user_id != $user_id) {
                return view('dashboard.error.error_404');
            }
        }

        $user = User::find($bid->user_id);

        return view('dashboard.profile', compact('title', 'user'));
    }
}
