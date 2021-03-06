<?php

namespace App\Console\Commands;

use App\Ebay\Sdk;
use Illuminate\Console\Command;
use Exception;
use Illuminate\Support\Facades\App;

class EbayCreateReturnPolicy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ebay:create-return-policy';

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
        if (App::environment('production')) {
            throw new Exception('This really should not be used in production. Sorry!');
        }

        $data = [
            'categoryTypes' => [
                ['name' => 'ALL_EXCLUDING_MOTORS_VEHICLES']
            ],
            'description' => 'test fulfillment policy',
            'marketplaceId' => 'EBAY_US',
            'name' => 'TEST 1',
            'returnPeriod' => [
                'unit' => 'DAY',
                'value' => 30,
            ],
            'returnsAccepted' => true,
            'returnShippingCostPayer' => 'BUYER',
        ];

        dd($ebay->createReturnPolicy($data));
    }
}
