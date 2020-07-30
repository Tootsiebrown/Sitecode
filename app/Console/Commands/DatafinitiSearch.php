<?php

namespace App\Console\Commands;

use App\Gateways\DatafinitiGateway;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

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
    protected $description = 'Pulls data from cache, if possible. Calls Datafiniti API if not.';

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
        $code = $this->argument('barcode');
        $key = $this->gateway->getKey($code);
        $results = Cache::store('database')->get($key);

        if (empty($results)) {
            $results = $this->gateway->barCodeSearch($code);
        }

        dd($results);
    }
}
