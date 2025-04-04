<?php

namespace Database\Factories\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users\UserAddress>
 */
class UserAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return tenant_columns([
            'user_id' => User::factory(),
            'country_code' => fake()->countryCode(),
            'type' => fake()->randomElement(['home', 'work']),
            'label' => fake()->word(),
            'street_line_1' => fake()->streetAddress(),
            'street_line_2' => fake()->secondaryAddress(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'postal_code' => fake()->postcode(),
            'is_primary' => fake()->boolean(20),
        ]);
    }
}
