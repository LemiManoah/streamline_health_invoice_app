<?php

namespace Modules\Client\Database\Factories;

use Modules\Client\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Client\Models\Subscription::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(), 
            'plan_name' => $this->faker->word,
            'billing_cycle_in_years' => $this->faker->numberBetween(1, 10),
            'start_date' => $this->faker->date,
            'next_billing_date' => $this->faker->date(),
            'amount' => $this->faker->randomFloat(2, 100, 10000),
            'status' => $this->faker->randomElement(['paid', 'unpaid']),
        ];
    }
}

