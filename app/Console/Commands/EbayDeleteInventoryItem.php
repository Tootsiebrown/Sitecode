<?php

namespace App\Console\Commands;

use App\Ebay\Sdk;
use Illuminate\Console\Command;

class EbayDeleteInventoryItem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ebay:delete-inventory-item {sku}';

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
    public function handle(Sdk $ebay)
    {
        dd($ebay->deleteInventoryItem($this->argument('sku')));
    }
}
