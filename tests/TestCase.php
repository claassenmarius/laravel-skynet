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
        $app->config->set('database.default', 'mysql');
        $app->config->set('database.connections.msql.database', 'forge');
        $app->config->set('database.connections.mysql.username', 'root');
        $app->config->set('database.connections.mysql.password', 'Ming2013');

        Schema::dropIfExists('quotes');
        // import the CreateQuotesTable class from our migration
        include_once __DIR__ . '/../database/migrations/create_quotes_table.php.stub';

        // run the up method of the migration
        (new \CreateQuotesTable())->up();
    }
}
