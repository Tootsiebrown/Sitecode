<?php

namespace Tests\Feature;

use App\Models\Listing;
use Illuminate\Support\Carbon;
use Tests\WaxAppTestCase;

class ApiExceptionHandlerJsonTest extends WaxAppTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow(Carbon::now());

        factory(Listing::class)->create([
            'id' => 2,
        ]);

        factory(Listing\Item::class, 5)->create([
            'listing_id' => 2
        ]);
    }

    public function testEbayRealtimeInventoryCheckOkay()
    {
        $response = $this->json(
            'POST',
            route('webhooks.ebayInventoryCheck', false),
            [
                'locationID' => config('services.ebay.merchant_location_key'),
                'SKU' => 'testing-2',
                'fulfillmentType' => 'SHIP_TO_HOME',
                'requestedQuantity' => 4
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson([
                'isAvailable' => true,
                'lastUpdated' => Carbon::now()->getTimestamp(),
                'totalAvailableQuantity' => 5
            ]);
    }

    public function testEbayRealtimeInventoryCheckUnavailable()
    {
        $response = $this->json(
            'POST',
            route('webhooks.ebayInventoryCheck', false),
            [
                'locationID' => config('services.ebay.merchant_location_key'),
                'SKU' => 'testing-2',
                'fulfillmentType' => 'SHIP_TO_HOME',
                'requestedQuantity' => 6
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson([
                'isAvailable' => false,
                'lastUpdated' => Carbon::now()->getTimestamp(),
                'totalAvailableQuantity' => 5
            ]);
    }
}
