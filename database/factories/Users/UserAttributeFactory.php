<?php

namespace Database\Factories\Users;

use App\Models\Attributes\AttributeDefinition;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users\UserAttribute>
 */
class UserAttributeFactory extends Factory
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
            'attribute_definition_id' => AttributeDefinition::factory(),
            'value' => fake()->word(),
            'encrypted_value' => null,
        ]);
    }
}
