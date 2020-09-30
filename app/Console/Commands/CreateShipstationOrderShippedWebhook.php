<?php

namespace App\Console\Commands;

use App\Wax\Shop\Services\ShippingService;
use Illuminate\Console\Command;

class CreateShipstationOrderShippedWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shipstation:create-order-shipped-webhook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(ShippingService $shippingService)
    {
        $webhooks = $shippingService->listShipstationWebHooks();

        if ($this->alreadyHasWebHook($webhooks)) {
            $this->info('webhook already exists');
            return;
        }

        $shippingService->createShipstationWebHookForOrderShipped();

        $this->info('webhook created');
    }

    protected function alreadyHasWebHook($webhooks) {
        if ($webhooks->isEmpty()) {
            return false;
        }

        $matchingWebHooks = $webhooks
            ->filter(function ($webhook) {
                return $webhook->StoreID == config('services.ship_station.store_id')
                    && $webhook->HookType ==  'SHIP_NOTIFY'
                    && $webhook->Url == route('webhooks.order-shipped');
            });

        return $matchingWebHooks->isNotEmpty();
    }
}
