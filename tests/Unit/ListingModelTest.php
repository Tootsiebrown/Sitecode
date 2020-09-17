<?php

namespace Tests\Unit;

use App\Models\Listing;
use App\Models\Listing\Item as ListingItem;
use Tests\WaxAppTestCase;

class ListingModelTest extends WaxAppTestCase
{
    public function testAvailableItems()
    {
        $listing = factory(Listing::class)->create();
        $listing->items()->saveMany(factory(ListingItem::class, 2)->make());

        $this->assertEquals(2, $listing->items->count());
        $this->assertEquals(2, $listing->availableItems->count());

        $anItem = $listing->items->first();
        $anItem->order_item_id = 23;
        $anItem->save();
        $listing->refresh();

        $this->assertEquals(2, $listing->items->count());
        $this->assertEquals(1, $listing->availableItems->count());
    }
}
