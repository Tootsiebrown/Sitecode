<?php

namespace Tests\Unit;

use App\Jobs\UpdateEbayOfferInventory;
use App\Models\Listing;
use App\Models\Listing\Item as ListingItem;
use App\Models\Offer;
use App\User;
use Illuminate\Support\Facades\Queue;
use Tests\WaxAppTestCase;

class OfferModelTest extends WaxAppTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Queue::fake();

        $this->user = factory(User::class)->create();
        $this->listing = factory(Listing::class)->create(['id' => 9034]);
        $this->listing->items()->saveMany(
            factory(ListingItem::class, 2)->make()
        );

        $this->assertEquals(2, $this->listing->items->count());
        $this->assertEquals(2, $this->listing->availableItems->count());

        $this->offer = factory(Offer::class)->create([
            'listing_id' => $this->listing->id,
            'quantity' => 1,
            'price' => 12,
            'user_id' => $this->user->id,
        ]);
    }

    public function testAcceptingOffer()
    {
        $this->offer->accept();

        Queue::assertPushed(UpdateEbayOfferInventory::class, function ($job) {
            return $job->listing->id === $this->listing->id;
        });
    }

    public function testCustomerAcceptingCounterOffer()
    {
        $this->offer->counter([
            'counter_quantity' => 1,
            'counter_price' => 9,
        ]);

        $this->offer->accept();

        Queue::assertPushed(UpdateEbayOfferInventory::class, function ($job) {
            return $job->listing->id === $this->listing->id;
        });
    }
}
