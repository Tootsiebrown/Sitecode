<?php

namespace Tests\Unit;

use App\Bid;
use App\Jobs\NotifyWatchersAuctionEnded;
use App\Mail\NotifyWatcherAuctionEnded;
use App\Models\Listing;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Tests\WaxAppTestCase;
use Wax\Shop\Services\ShopService;

class NotifyWatchersTest extends WaxAppTestCase
{
    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    protected $shopService;

    public function setUp(): void
    {
        parent::setUp();
        Mail::fake();

        $this->shopService = app(ShopService::class);
    }

    public function testProperNotifications()
    {
        $listing = factory(Listing::class)->create([
            'expired_at' => Carbon::now()->subMinute(),
            'type' => 'auction',
            'price' => 25,
        ]);

        $winner = factory(User::class)->create();
        $listing->bids()->save(new Bid(['user_id' => $winner->id, 'bid_amount' => 27]));

        $watcher = factory(User::class)->create();

        $listing->watchers()->attach($watcher->id);

        (new NotifyWatchersAuctionEnded($listing))->handle();

        Mail::assertQueued(NotifyWatcherAuctionEnded::class, function ($mail) use ($listing, $watcher) {
            return $mail->listing->id === $listing->id
                && $mail->to[0]['address'] === $watcher->email;
        });

        Mail::assertNotQueued(NotifyWatcherAuctionEnded::class, function ($mail) use ($winner) {
            return $mail->to[0]['address'] === $winner->email;
        });
    }
}

