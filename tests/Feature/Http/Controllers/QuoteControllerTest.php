<?php


namespace Claassenmarius\LaravelSkynet\Tests\Feature\Http\Controllers;

use Claassenmarius\LaravelSkynet\Tests\TestCase;

class QuoteControllerTest extends TestCase
{
    /** @test */
    public function the_quote_controller_returns_invoked_text()
    {
        $this->get('/quote')
            ->assertOk()
            ->assertSee('invoked');
    }
}
