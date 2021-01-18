<?php

namespace App\Console\Commands;

use App\Jobs\Ebay\PostListing;
use App\Models\Listing;
use Illuminate\Console\Command;

class EbayProcessListingsToPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ebay:process-ready-listings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process listings that need to go to ebay';

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
    public function handle()
    {
        Listing::readyForEbay()
            ->get()
            ->each(function ($listing) {
                PostListing::dispatch($listing)->onQueue('slow');
            });
    }
}
