<?php

namespace Database\Factories\Identities;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Identities\DocumentType>
 */
class DocumentTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'country_code' => fake()->countryCode(),
            'name' => fake()->randomElement(['DNI', 'Passport', 'Driver License']),
            'regex_pattern' => null,
            'requires_expiration' => fake()->boolean(20),
        ];
    }
}
