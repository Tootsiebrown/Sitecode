<?php

namespace Tests;

use Wax\Core\Support\ConfigurationDatabase;

trait PrepsShopEmailMocks
{
    protected $testMailFrom = 'noreply@example.org';
    protected $testMailTo = 'test1@example.org, test2@example.org';

    protected function prepShopEmailMocks()
    {
        app()->bind(ConfigurationDatabase::class, function () {
            $double = \Mockery::mock(ConfigurationDatabase::class);
            $double->shouldReceive('get')
                ->with('WEBSITE_MAILFROM')
                ->andReturn($this->testMailFrom);

            $double->shouldReceive('get')
                ->with('WEBSITE_MAILTO')
                ->andReturn($this->testMailTo);

            return $double;
        });
    }
}
