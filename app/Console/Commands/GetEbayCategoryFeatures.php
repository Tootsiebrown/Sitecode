<?php

namespace App\Console\Commands;

use App\Ebay\Sdk;
use Illuminate\Console\Command;

class GetEbayCategoryFeatures extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ebay:get-category-features {categoryId?} {--featureId=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the category details';

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
        $response = $this->ebay->getEbayCategoryFeatures(
            $this->argument('categoryId'),
            $this->option('featureId')
        );

        print_r($response);
    }
}
