<?php

namespace App\Console\Commands;

use App\Ebay\Sdk;
use Illuminate\Console\Command;

class ListEbayLocations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ebay:list-locations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List Ebay Locations';
    /** @var Sdk */
    private Sdk $ebay;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Sdk $ebay)
    {
        $this->ebay = $ebay;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        dd($this->ebay->getLocations());
    }
}
