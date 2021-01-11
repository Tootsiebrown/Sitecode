<?php

namespace Tests\Unit;

use App\Jobs\UpdateEbayOfferInventory;
use App\Listeners\OrderPlacedEbayInventoryListener;
use App\Models\Listing;
use App\Models\Listing\Item as ListingItem;
use App\Wax\Shop\Models\Order\ShippingRate;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Mockery;
use Tests\Shop\Traits\GeneratesCreditCardPayments;
use Tests\Shop\Traits\SetsShippingAddress;
use Tests\PrepsShopEmailMocks;
use Tests\WaxAppTestCase;
use Wax\Shop\Events\OrderPlacedEvent;
use Wax\Shop\Payment\Drivers\CreditCardPaymentDummyDriver;
use Wax\Shop\Payment\PaymentTypeFactory;
use Wax\Shop\Services\ShopService;

class OrderPlacedEbayInventoryListenerTest extends WaxAppTestCase
{
    use GeneratesCreditCardPayments;
    use SetsShippingAddress;
    use PrepsShopEmailMocks;

    /* @var ShopService $shop */
    protected $shopService;
    /** @var Listing */
    private $listing;
    /** @var Listing */
    private $listing2;
    /** @var Listing */
    private $listing3;

    public function setUp(): void
    {
        parent::setUp();

        $this->shopService = app()->make(ShopService::class);
        config(['wax.shop.payment.credit_card_payment_driver' => CreditCardPaymentDummyDriver::class]);

        $this->listing = factory(Listing::class)->create(['price' => 26, 'id' => 46, 'ebay_offer_id' => 1234]);
        $this->listing->items()->saveMany(factory(ListingItem::class, 3)->make());

        $this->listing2 = factory(Listing::class)->create(['price' => 22, 'id' => 50, 'ebay_offer_id' => 86738]);
        $this->listing2->items()->saveMany(factory(ListingItem::class, 3)->make());

        $this->listing3 = factory(Listing::class)->create(['price' => 21, 'id' => 67]);
        $this->listing3->items()->saveMany(factory(ListingItem::class, 3)->make());

        Mail::fake();
        Queue::fake();

        $this->prepShopEmailMocks();
    }

    public function testListenerCalled()
    {
        $listener = Mockery::spy(OrderPlacedEbayInventoryListener::class);
        app()->instance(OrderPlacedEbayInventoryListener::class, $listener);

        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing->id]);

        $this->setShippingAddress();
        $this->shopService->setShippingService(factory(ShippingRate::class)->create());

        $this->shopService->calculateTax();

        // make the payment
        $data = $this->generateCreditCardPaymentData();

        $card = PaymentTypeFactory::create('credit_card', $data);

        $this->shopService->applyPayment($card);

        $listener->shouldHaveReceived('handle')
            ->with(Mockery::on(function ($event) {
                return $event->order()->items->contains(function ($item) {
                    return $item->listing->id === $this->listing->id;
                });
            }))
            ->once();
    }

    public function testListenerQueuesUpdateEbayInventoryJob()
    {
        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing->id]);
        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing2->id]);
        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing3->id]);

        $listener = app()->make(OrderPlacedEbayInventoryListener::class);
        $event = new OrderPlacedEvent($this->shopService->getActiveOrder());

        $listener->handle($event);

        Queue::assertPushed(UpdateEbayOfferInventory::class, function ($job) {
            return $job->listing->id === $this->listing->id;
        });

        Queue::assertPushed(UpdateEbayOfferInventory::class, function ($job) {
            return $job->listing->id === $this->listing2->id;
        });

        Queue::assertNotPushed(UpdateEbayOfferInventory::class, function ($job) {
            return $job->listing->id === $this->listing3->id;
        });
    }

}
