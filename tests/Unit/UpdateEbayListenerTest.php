<?php

namespace Tests\Unit;

use App\Events\InventoryChangedEvent;
use App\Listeners\UpdateEbayInventory;
use App\Models\Listing;
use Illuminate\Support\Facades\Event;
use Mockery;
use Tests\WaxAppTestCase;

class UpdateEbayListenerTest extends WaxAppTestCase
{

    public function setUp(): void
    {
        parent::setUp();

        $this->listing1 = factory(Listing::class)->create(['id' => 35]);
        factory(Listing\Item::class, 5)->create(['listing_id' => 35]);

        $this->listing2 = factory(Listing::class)->create(['id' => 57]);
        factory(Listing\Item::class, 5)->create(['listing_id' => 57]);
    }

    public function testListenerInventoryChangedEvent()
    {
        $listener = Mockery::spy(UpdateEbayInventory::class);
        app()->instance(UpdateEbayInventory::class, $listener);

        Event::dispatch(new InventoryChangedEvent(($this->listing1)));

        $listener->shouldHaveReceived('handle')
            ->with(Mockery::on(function ($event) {
                return $event->listing->id === $this->listing1->id;
            }))
            ->once();
    }
}
