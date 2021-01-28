<?php

namespace Tests\Unit;

use App\Models\Listing;
use App\Models\Listing\Item as ListingItem;
use App\Models\Offer;
use App\User;
use App\Wax\Shop\Support\CheckoutInventoryManager;
use Illuminate\Support\Facades\Queue;
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

    /** @var \Illuminate\Contracts\Foundation\Application|mixed */
    protected $shopService;
    private $offer;

    public function setUp(): void
    {
        parent::setUp();
        $this->inventoryManager = app(CheckoutInventoryManager::class);

        $this->shopService = app(ShopService::class);
        $this->order = $this->shopService->getActiveOrder();
        $this->listing = factory(Listing::class)->create();
        $this->listing->items()->saveMany(factory(ListingItem::class, 2)->make());
        $this->user = factory(User::class)->create();
        $this->offer = factory(Offer::class)->create([
            'user_id' => $this->user->id,
            'listing_id' => $this->listing->id,
            'quantity' => 1,
            'price' => 5
        ]);

        Queue::fake();
    }

    public function testReserveItems()
    {
        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing->id]);
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

    public function testReserveItemsWhenSomeoneElseHasOffer()
    {
        $this->offer->accept();
        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing->id]);

        $this->assertTrue($this->listing->items->count() > 0);
        $this->listing->items->each(function($item) {
            $this->assertNull($item->reserved_by_order_id);
        });

        $this->inventoryManager->reserveItems($this->order);

        $this->assertTrue($this->listing->items()->count() === 2);
        $this->assertEquals(2, $this->listing->items()->reserved()->count());
        $this->assertEquals(0, $this->listing->items()->notReserved()->count());
    }

    public function testReserveForMyOffer()
    {
        $this->offer->accept();
        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing->id, $this->offer->id]);

        $order = $this->shopService->getActiveOrder();

        $this->assertTrue($this->listing->items->count() > 0);
        $this->listing->items->each(function($item) {
            $this->assertNull($item->reserved_by_order_id);
        });

        $this->inventoryManager->reserveItems($this->order);

        $this->assertTrue($this->listing->items()->count() === 2);
        $this->assertEquals(1, $this->listing->items()->reserved()->count());
        $this->assertEquals(1, $this->listing->items()->notReserved()->count());
    }
}
