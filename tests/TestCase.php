<?php

namespace Claassenmarius\LaravelSkynet\Tests;

use Claassenmarius\LaravelSkynet\SkynetServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        //additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            SkynetServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
