<?php

namespace Modules\Invoice\Database\Factories;

use Modules\Invoice\Models\Invoice;
use Modules\Client\Models\Client;
use Modules\Client\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(), // Use factory to create a related client
            'subscription_id' => Subscription::factory(), // Use factory to create a related subscription
            'due_date' => $this->faker->date(),
            'total_amount' => $this->faker->randomFloat(2, 100, 10000),
            'status' => $this->faker->randomElement(['Paid', 'Unpaid']),
        ];
    }
}
