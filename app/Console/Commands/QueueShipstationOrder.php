<?php

namespace App\Console\Commands;

use App\Jobs\OrderToShipstation;
use App\Wax\Shop\Models\Order;
use Illuminate\Console\Command;

class QueueShipstationOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shipping:sync-order {orderId}';

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
    public function handle()
    {
        OrderToShipstation::dispatch(Order::find($this->argument('orderId')));
    }
}
