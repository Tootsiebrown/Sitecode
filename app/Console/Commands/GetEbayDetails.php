<?php

namespace App\Console\Commands;

use App\Ebay\Sdk;
use Illuminate\Console\Command;

class GetEbayDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ebay:get-details {detail*} --';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the details for the ebay store';

    /** @var Sdk */
    private Sdk $ebay;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Sdk $ebay)
    {
        parent::__construct();

        $this->ebay = $ebay;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        dump($this->ebay->getEbayDetails(...$this->argument('detail')));
    }
}
