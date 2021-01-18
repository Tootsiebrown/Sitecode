<?php

namespace App\Console\Commands;

use App\Jobs\Ebay\PostListing;
use App\Models\Listing;
use Illuminate\Console\Command;

class EbayPostListing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ebay:post-listing {listingId}';

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
        $listing = Listing::find($this->argument('listingId'));

        PostListing::dispatch($listing);
    }
}
