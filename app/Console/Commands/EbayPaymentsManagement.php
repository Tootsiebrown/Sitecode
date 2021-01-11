<?php

namespace App\Console\Commands;

use App\Ebay\Sdk;
use Illuminate\Console\Command;

class EbayPaymentsManagement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ebay:payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get/Set eBay managed payments program status';

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
        $headers = ['Aspect', 'Status'];
        $data = [];

        $status = $ebay->getPaymentsProgramStatus();
        $data[] = ['Aspect' => 'Program', 'Status' => $status->status];

        if ($status->status === 'NOT_OPTED_IN') {
            $onboardingStatus = $ebay->getPaymentsProgramOnboardingStatus();
            dump($onboardingStatus);
        }

        $this->table($headers, $data);
    }
}
