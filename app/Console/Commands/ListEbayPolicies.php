<?php

namespace App\Console\Commands;

use App\Ebay\Sdk;
use Illuminate\Console\Command;
use Exception;

class ListEbayPolicies extends Command
{
    protected array $allowedTypes = ['return', 'payment', 'fulfillment'];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ebay:list-policies {type}';

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
        $type = $this->argument('type');

        if (!in_array($type, $this->allowedTypes)) {
            throw new Exception(($type . ' is not an allowed policy type'));
        }

        dd($ebay->getPolicies($type));
    }
}
