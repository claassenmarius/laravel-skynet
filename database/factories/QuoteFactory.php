<?php

namespace Claassenmarius\LaravelSkynet\Database\Factories;

use Claassenmarius\LaravelSkynet\Models\Quote;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuoteFactory extends Factory
{

    protected $model = Quote::class;

    public function definition()
    {
        return [
            'total_charge' => $this->faker->numberBetween(50, 200),
            'total_vat' => $this->faker->numberBetween(15, 50),
            'error_code' => $this->faker->numberBetween(0, 1),
            'error_description' => $this->faker->word(),
            'paid' => $this->faker->boolean(),
            'cancelled' => $this->faker->boolean()
        ];
    }
}
