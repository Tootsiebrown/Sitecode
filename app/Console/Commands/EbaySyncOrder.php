<?php

namespace App\Console\Commands;

use App\Jobs\SyncEbayOrder;
use Illuminate\Console\Command;

class EbaySyncOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ebay:sync-order {orderId}';

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
     * @return mixed
     */
    public function handle()
    {
        SyncEbayOrder::dispatch($this->argument('orderId'));

        $this->info('dispatched');
    }
}
