<?php

namespace Tests\Unit;

use App\Bid;
use App\Jobs\NotifyWinner;
use App\Mail\NotifyNoWinner as NotifyNoWinnerEmail;
use App\Mail\NotifyWinner as NotifyWinnerEmail;
use App\Models\Listing;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\WaxAppTestCase;
use Wax\Shop\Services\ShopService;

class NotifyWinnerTest extends WaxAppTestCase
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

    public function testNoWinner()
    {
        $listing = factory(Listing::class)->create([
            'expired_at' => Carbon::now()->subMinute(),
            'type' => 'auction',
            'price' => 25,
        ]);

        (new NotifyWinner($listing))->handle();

        Mail::assertQueued(NotifyNoWinnerEmail::class, function ($mail) use ($listing) {
            return $mail->listing->id === $listing->id;
        });
    }

    public function testWinner()
    {
        $listing = factory(Listing::class)->create([
            'expired_at' => Carbon::now()->subMinute(),
            'type' => 'auction',
            'price' => 25,
        ]);

        $user = factory(User::class)->create();

        $listing->bids()->save(new Bid(['user_id' => $user->id, 'bid_amount' => 27]));

        (new NotifyWinner($listing))->handle();

        Mail::assertNotQueued(NotifyNoWinnerEmail::class);

        Mail::assertQueued(NotifyWinnerEmail::class, function ($mail) use ($listing, $user) {
            return $mail->listing->id === $listing->id
                && $mail->user->id == $user->id;
        });
    }
}

