<?php

namespace App\Console\Commands;

use App\Ebay\Sdk;
use Illuminate\Console\Command;

class EbayGetOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ebay:get-orders {limit=10} {offset=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get orders';

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
     * @param Sdk $ebay
     * @return mixed
     */
    public function handle(Sdk $ebay): bool
    {
        $orders = $ebay->getOrders($this->argument('limit'), $this->argument('offset'));

        dd($orders);
    }
}
