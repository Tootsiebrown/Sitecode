<?php

namespace App\Http\Controllers;

use App\Bid;
use App\Mail\CounterOfferExpired;
use App\Mail\NotifyNoWinner;
use App\Mail\NotifyWatcherAuctionEnded;
use App\Mail\NotifyWatcherAuctionEndingSoon;
use App\Mail\NotifyWatcherBidReceived;
use App\Mail\NotifyWinner;
use App\Mail\NotifyWinnerPaymentNeeded;
use App\Mail\OfferCountered;
use App\Mail\OfferExpired;
use App\Mail\OfferRejected;
use App\Mail\OfferSubmitted;
use App\Mail\OfferAccepted;
use App\Mail\SomeoneElseboughtIt;
use App\Models\Listing;
use App\Models\Offer;
use App\Rules\AuctionIsPayable;
use App\Rules\AuctionWonByCurrentUser;
use App\Wax\Shop\Models\Order;
use App\Wax\Shop\Models\Order\Item;
use App\Wax\Shop\Models\Order\Shipment;
use App\Wax\Shop\Models\Product\Customization;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Wax\Shop\Facades\ShopServiceFacade;
use Wax\Shop\Mail\OrderPlaced;
use Wax\Shop\Mail\OrderShipped;

class MailPreviewController extends Controller
{
    protected $emails = [
        'order-placed' => 'Order Placed',
        'auction-won' => 'Auction Won',
        'auction-ended-no-winner' => 'Auction Ended With No Winner',
        'order-shipped' => 'Order Shipped',
        'offer-submitted' => 'Offer Submitted',
        'offer-accepted' => 'Offer Accepted',
        'offer-rejected' => 'Offer Rejected',
        'offer-countered' => 'Offer Countered',
        'watcher-ended' => 'Notify Watcher Auction Ended',
        'bid-received' => 'Notify Watcher Bid Received',
        'auction-ending' => 'Notify Watcher Auction Ending Soon',
        'offer-expired' => 'Offer Expired',
        'counter-offer-expired' => 'Counter Offer Expired',
        'someone-else-bought-it' => 'Someone Else Bought It',
        'auction-payment-needed' => '12-Hour Auction Payment Needed',
    ];

    public function index()
    {
        return view('dashboard.emails.index', [
            'emails' => $this->emails,
        ]);
    }

    public function iFrame($slug)
    {
        return view('dashboard.emails.iframe', [
            'emailSlug' => $slug,
            'title' => $this->emails[$slug],
        ]);
    }

    public function auctionWon()
    {
        $listing = factory(Listing::class)->make([
            'expired_at' => Carbon::now()->subMinute(),
            'title' => 'Test Listing Title',
            'id' => 13
        ]);

        return new NotifyWinner($listing, Auth::user());
    }

    public function orderPlaced()
    {
        return new OrderPlaced(Order::placed()->first());
    }

    public function orderShipped()
    {
        return new OrderShipped(Order::shipped()->first());
    }

    public function auctionEndedNoWinner()
    {
        $listing = factory(Listing::class)->make([
            'expired_at' => Carbon::now()->subMinute(),
            'title' => 'Test Listing Title',
            'id' => 13
        ]);

        return new NotifyNoWinner($listing);
    }

    public function offerSubmitted()
    {
        $listing = factory(Listing::class)->make([
            'expired_at' => Carbon::now()->subMinute(),
            'title' => 'Test Listing Title',
            'id' => 13
        ]);
        $offer = new Offer([
            'listing_id' => 13,
            'user_id' => Auth::user()->id,
            'quantity' => 2,
            'price' => 49.99,
            'id' => 5,
        ]);

        return new OfferSubmitted(
            $offer,
            $listing,
            2,
            49.99,
            Auth::user(),
        );
    }

    public function offerAccepted()
    {
        $listing = Listing::first();
        $offer = new Offer([
            'listing_id' => $listing->id,
            'user_id' => Auth::user()->id,
            'quantity' => 2,
            'price' => 49.99,
            'id' => 5,
        ]);

        return new OfferAccepted($offer);
    }

    public function offerRejected()
    {
        $listing = Listing::first();
        $offer = new Offer([
            'listing_id' => $listing->id,
            'user_id' => Auth::user()->id,
            'quantity' => 2,
            'price' => 49.99,
            'id' => 5,
        ]);

        return new OfferRejected($offer);
    }

    public function offerCountered()
    {
        $listing = Listing::first();
        $offer = new Offer([
            'listing_id' => $listing->id,
            'user_id' => Auth::user()->id,
            'quantity' => 2,
            'price' => 49.99,
            'id' => 5,
            'counter_quantity' => 1,
            'counter_price' => 52.50,
        ]);

        return new OfferCountered($offer);
    }

    public function notifyWatcherAuctionEnded()
    {
        $listing = Listing::typeIsAuction()
            ->first();

        return new NotifyWatcherAuctionEnded($listing);
    }

    public function notifyWatcherBidReceived()
    {
        $bid = Bid::first();

        return new NotifyWatcherBidReceived($bid);
    }

    public function notifyWatcherAuctionEndingSoon()
    {
        $listing = Listing::typeIsAuction()
            ->first();

        return new NotifyWatcherAuctionEndingSoon($listing);
    }

    public function offerExpired()
    {
        $listing = Listing::first();
        $offer = new Offer([
            'listing_id' => $listing->id,
            'user_id' => Auth::user()->id,
            'quantity' => 2,
            'price' => 49.99,
            'id' => 5,
        ]);

        return new OfferExpired($offer);
    }

    public function counterOfferExpired()
    {
        $listing = Listing::first();
        $offer = new Offer([
            'listing_id' => $listing->id,
            'user_id' => Auth::user()->id,
            'quantity' => 2,
            'price' => 49.99,
            'id' => 5,
            'counter_quantity' => 1,
            'counter_price' => 55.50,
        ]);

        return new CounterOfferExpired($offer);
    }

    public function someoneElseBoughtIt()
    {
        $listing = Listing::first();
        $offer = new Offer([
            'listing_id' => $listing->id,
            'user_id' => Auth::user()->id,
            'quantity' => 2,
            'price' => 49.99,
            'id' => 5,
            'counter_quantity' => 1,
            'counter_price' => 55.50,
        ]);

        return new SomeoneElseboughtIt($offer);
    }

    public function auctionPaymentNeeded()
    {
        return new NotifyWinnerPaymentNeeded(Listing::first());
    }
}
