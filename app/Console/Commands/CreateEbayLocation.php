<?php

namespace App\Console\Commands;

use App\Ebay\Sdk;
use Illuminate\Console\Command;

class CreateEbayLocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ebay:create-location';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
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
        $response = $this->ebay->createLocation(
            1,
            [
                'location' => [
                    'address' => [
                        'country' => 'US',
                        'postalCode' => '40741'
                    ],
                ],
                'name' => 'Louisville Warehouse',
            ]
        );

        dd($response);
    }
}
