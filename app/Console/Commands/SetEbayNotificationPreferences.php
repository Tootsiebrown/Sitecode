<?php

namespace App\Console\Commands;

use App\Ebay\Legacy\LegacySdk;
use Illuminate\Console\Command;

class SetEbayNotificationPreferences extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ebay:set-notification-preferences {subscribed=1}';

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
    public function handle(LegacySdk $ebay)
    {
        dd($ebay->setNotificationPreferences((bool) $this->argument('subscribed')));
    }
}
