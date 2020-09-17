<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Wax\Core\Facades\OgTags;
use Wax\Core\Facades\GoogleAnalytics;
use Wax\Core\Facades\BugHerd;
use Wax\Core\Support\ConfigurationDatabase;

abstract class WaxAppTestCase extends TestCase
{
    use RefreshDatabase;

/*
    public function setUpTraits()
    {
        $this->artisan('migrate', [
            '--path' => 'vendor/oohology/wax-cms/modules/core/database/migrations',
        ]);

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback', [
                '--path' => 'vendor/oohology/wax-cms/modules/core/database/migrations',
            ]);
        });

        parent::setUpTraits();
    }
*/
    public function setUp(): void
    {
        parent::setUp();

        // Enable foreign key support for SQLITE databases
        if (DB::connection() instanceof \Illuminate\Database\SQLiteConnection) {
            DB::statement(DB::raw('PRAGMA foreign_keys=on'));
        }

        OgTags::shouldReceive('draw');
        GoogleAnalytics::shouldReceive('draw');
        BugHerd::shouldReceive('draw');

        // Prevent SystemNotice from trying to send an email alert
        $siteSettings = new ConfigurationDatabase('Site Settings');
        $siteSettings->set('DEV_EMAIL_ALERT', '', 'VARCHAR');
    }

}
