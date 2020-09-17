<?php

namespace Tests\Unit;

use App\Models\Listing;
use App\Models\Listing\Item as ListingItem;
use App\Wax\Shop\Validators\OrderItemValidator;
use Tests\WaxAppTestCase;
use Wax\Shop\Services\ShopService;
use Wax\Shop\Tax\Drivers\DbDriver;

class OrderItemValidatorTest extends WaxAppTestCase
{
    /* @var ShopService */
    protected $shopService;

    /* @var Listing */
    protected $listing;

    public function setUp(): void
    {
        parent::setUp();

        $this->shopService = app()->make(ShopService::class);

        config(['wax.shop.tax_driver' => DbDriver::class]);

        $this->listing = factory(Listing::class)->create();
        $this->listing->items()->saveMany(factory(ListingItem::class, 2)->make());
    }

    public function testInventoryAvailable()
    {
        $this->assertTrue(
            app()->make(OrderItemValidator::class)
                ->setRequest(1, 2, [], [1 => $this->listing->id])
                ->passes()
        );
    }

    public function testNoInventory()
    {
        $this->listing->items()->update(['order_item_id' => 1234]);

        $this->assertFalse(
            app()->make(OrderItemValidator::class)
                ->setRequest(1, 2, [], [1 => $this->listing->id])
                ->passes()
        );
    }

    public function testAlreadyInCart()
    {
        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing->id]);

        $this->assertTrue(
            app()->make(OrderItemValidator::class)
                ->setRequest(1, 1, [], [1 => $this->listing->id])
                ->passes()
        );
    }

    public function testAlreadyInCartNoInventory()
    {
        $this->shopService->addOrderItem(1, 2, [], [1 => $this->listing->id]);

        $this->assertFalse(
            app()->make(OrderItemValidator::class)
                ->setRequest(1, 1, [], [1 => $this->listing->id])
                ->passes()
        );
    }
}
