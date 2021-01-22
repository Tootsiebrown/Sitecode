<?php

namespace App\Console\Commands;

use App\Ebay\Sdk;
use App\Jobs\Ebay\SyncOrder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

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
        $job = new SyncOrder($this->argument('orderId'), true);

        $job->handle(App::make(Sdk::class));

        $this->info('synced');

        return true;
    }
}
