<?php


namespace Claassenmarius\LaravelSkynet\Tests\Unit;


use Claassenmarius\LaravelSkynet\Models\Quote;
use Claassenmarius\LaravelSkynet\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuoteTest extends TestCase
{
//    use RefreshDatabase;

//    protected function usesMySqlConnection($app)
//    {
//
//    }

    /** @test */
    public function quotes_can_be_created()
    {
        Quote::factory()->count(3)->create();

        $this->assertDatabaseCount('quotes', 3);
    }


    /** @test */
    public function verify_quote_details_when_created()
    {
        $quote = Quote::factory()->create([
           'total_charge' => '100.00',
            'total_vat' => '15.00',
            'error_code' => '0',
            'error_description' => 'Success',
            'paid' => true,
            'cancelled' => false
        ]);

        $this->assertEquals('100.00', $quote->total_charge);
        $this->assertEquals('15.00', $quote->total_vat);
        $this->assertEquals('0', $quote->error_code);
        $this->assertEquals('Success', $quote->error_description);
        $this->assertEquals(true, $quote->paid);
        $this->assertEquals(false, $quote->cancelled);
    }
}
