<?php

namespace Database\Factories\Attributes;

use App\Enums\Models\Attributes\AttributeDefinitionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attributes\AttributeDefinition>
 */
class AttributeDefinitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => fake()->unique()->slug(),
            'label' => fake()->words(2, true),
            'type' => fake()->randomElement(AttributeDefinitionType::cases()),
            'is_required' => fake()->boolean(30),
            'is_visible' => true,
            'should_encrypt' => false,
            'regex_pattern' => null,
        ];
    }
}
