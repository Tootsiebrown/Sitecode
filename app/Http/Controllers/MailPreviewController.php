<?php

namespace App\Http\Controllers;

use App\Mail\NotifyNoWinner;
use App\Mail\NotifyWinner;
use App\Models\Listing;
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
        return new OrderShipped(Order::placed()->first());
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
}
