<?php

namespace Tests\Unit;

use App\Models\Listing;
use App\Models\Listing\Item as ListingItem;
use App\Wax\Shop\Support\CheckoutInventoryManager;
use Tests\WaxAppTestCase;
use Wax\Shop\Services\ShopService;

class CheckoutInventoryManagerTest extends WaxAppTestCase
{

    /** @var \App\Wax\Shop\Models\Order */
    protected $order;

    /** @var Listing */
    protected $listing;

    /** @var CheckoutInventoryManager */
    protected $inventoryManager;

    public function setUp(): void
    {
        parent::setUp();
        $this->inventoryManager = app(CheckoutInventoryManager::class);

        $shopService = app(ShopService::class);
        $this->order = $shopService->getActiveOrder();
        $this->listing = factory(Listing::class)->create();
        $this->listing->items()->saveMany(factory(ListingItem::class, 2)->make());
        $shopService->addOrderItem(1, 1, [], [1 => $this->listing->id]);
    }

    public function testReserveItems()
    {
        $this->assertTrue($this->listing->items->count() > 0);
        $this->listing->items->each(function($item) {
            $this->assertNull($item->reserved_by_order_id);
        });

        $this->inventoryManager->reserveItems($this->order);

        $this->assertTrue($this->listing->items()->count() === 2);
        $this->assertEquals(1, $this->listing->items()->reserved()->count());
        $this->assertEquals(1, $this->listing->items()->notReserved()->count());
    }

    public function testReleaseItems()
    {
        $this->testReserveItems();

        $this->inventoryManager->releaseItems($this->order);

        $this->assertTrue($this->listing->items()->count() === 2);
        $this->assertEquals(0, $this->listing->items()->reserved()->count());
        $this->assertEquals(2, $this->listing->items()->notReserved()->count());
    }

    public function testMarkSold()
    {
        $this->testReserveItems();

        $this->inventoryManager->markItemsSold($this->order);

        $this->assertTrue($this->listing->items()->count() === 2);
        $this->assertEquals(1, $this->listing->items()->reserved()->count());
        $this->assertEquals(1, $this->listing->items()->notReserved()->count());
        $this->assertEquals(1, $this->listing->items()->available()->count());
        $this->assertEquals(1, $this->listing->items()->sold()->count());
    }
}
