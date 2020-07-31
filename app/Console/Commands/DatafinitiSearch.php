<?php

namespace App\Console\Commands;

use App\Gateways\DatafinitiGateway;
use Illuminate\Console\Command;

class DatafinitiSearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'datafiniti:search {barcode}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dumps Datafiniti data for a given barcode.';

    protected $gateway;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DatafinitiGateway $gateway)
    {
        parent::__construct();

        $this->gateway = $gateway;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        dd($this->gateway->barCodeSearch($code));
    }
}
