<?php

namespace Modules\Client\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Client\Models\Client;

class ClientFactory extends Factory
{
    // Define the corresponding model for the factory
    protected $model = Client::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'facility_level' => $this->faker->randomElement(['HCI', 'HCII', 'HCIII', 'HCIV', 'Clinic', 'Hospital']),
            'location' => $this->faker->address,
            'client_email' => $this->faker->unique()->safeEmail,
            'contact_person_name' => $this->faker->name,
            'contact_person_phone' => $this->faker->phoneNumber,
            'streamline_engineer_name' => $this->faker->name,
            'streamline_engineer_phone' => $this->faker->phoneNumber,
            'streamline_engineer_email' => $this->faker->safeEmail,
            'email_verified_at' => $this->faker->optional()->dateTime,
            'verification_token' => $this->faker->optional()->sha256,
            'verification_status' => $this->faker->randomElement(['verified', 'unverified']),
        ];
    }
}
