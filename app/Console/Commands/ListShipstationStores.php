<?php

namespace App\Console\Commands;

use App\Wax\Shop\Services\ShippingService;
use Illuminate\Console\Command;

class ListShipstationStores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shipstation:list-stores';

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
        $this->table(
            [
                'Store ID',
                'Store Name',
                'Marketplace ID',
                'Marketplace Name',
            ],
            $shippingService->listShipstationStores()
                ->map(function ($store) {
                    unset($store["accountName"]);
                    unset($store["email"]);
                    unset($store["integrationUrl"]);
                    unset($store["active"]);
                    unset($store["companyName"]);
                    unset($store["phone"]);
                    unset($store["publicEmail"]);
                    unset($store["website"]);
                    unset($store["refreshDate"]);
                    unset($store["lastRefreshAttempt"]);
                    unset($store["createDate"]);
                    unset($store["modifyDate"]);
                    unset($store["autoRefresh"]);
                    unset($store["statusMappings"]);

                    return $store;
                })
        );
    }
}
