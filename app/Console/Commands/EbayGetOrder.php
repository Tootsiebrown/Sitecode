<?php

namespace App\Console\Commands;

use App\Ebay\Sdk;
use Illuminate\Console\Command;

class EbayGetOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ebay:get-order {orderId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync an order that was placed on ebay with the right inventory stuff locally';

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
        $order = $ebay->getOrder($this->argument('orderId'));

        dd($order);
    }
}
