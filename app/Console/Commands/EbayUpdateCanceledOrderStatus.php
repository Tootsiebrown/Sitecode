<?php

namespace App\Console\Commands;

use App\Ebay\Sdk;
use Illuminate\Console\Command;

class EbayUpdateCanceledOrderStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ebay:update-canceled-order-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for recently cancelled orders, and sync status';

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
    public function handle(Sdk $ebay)
    {
        dd($ebay->getRecentCancellations());
    }
}
