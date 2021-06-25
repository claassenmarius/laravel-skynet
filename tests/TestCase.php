<?php

namespace Claassenmarius\LaravelSkynet\Tests;

use Claassenmarius\LaravelSkynet\SkynetServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

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

    protected function defineEnvironment($app)
    {
        include_once __DIR__ . '/../database/migrations/create_quotes_table.php.stub';

        (new \CreateQuotesTable())->up();
    }
}
