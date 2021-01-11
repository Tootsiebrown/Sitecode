<?php

namespace Tests\Unit;

use App\Jobs\MarkEbayItemsSold;
use App\Models\EbayOrder;
use App\Models\Listing;
use Illuminate\Support\Facades\Queue;
use Tests\WaxAppTestCase;

class MarkEbayItemsSoldTest extends WaxAppTestCase
{
    private $mockOrderId = 369;

    public function setUp(): void
    {
        parent::setUp();

        $this->ebayOrder = new EbayOrder(['ebay_id' => '34654']);
        $this->ebayOrder->save();

        $this->listing = factory(Listing::class)
            ->create(['id' => 357]);

        factory(Listing\Item::class, 3)
            ->create(['listing_id' => $this->listing->id]);
    }

    public function testSaveOrder()
    {
        $job = new MarkEbayItemsSold(
            $this->ebayOrder->id,
            $this->listing->id,
            2,
        );

        $job->handle();

        $this->assertEquals(3, $this->listing->items()->count());

        $this->assertEquals(1, $this->listing->availableItems()-count());
    }
}

