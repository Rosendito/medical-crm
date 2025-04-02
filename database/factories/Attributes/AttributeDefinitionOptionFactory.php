<?php

namespace Database\Factories\Attributes;

use App\Models\Attributes\AttributeDefinition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attributes\AttributeDefinitionOption>
 */
class AttributeDefinitionOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'attribute_definition_id' => AttributeDefinition::factory(),
            'value' => fake()->slug(),
            'encrypted_value' => null,
            'label' => fake()->word(),
            'order' => fake()->numberBetween(0, 10),
        ];
    }
}
