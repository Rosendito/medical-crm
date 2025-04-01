<?php

namespace Database\Factories\Users;

use App\Models\Attributes\AttributeDefinitionOption;
use App\Models\Users\UserAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users\UserAttributeSelection>
 */
class UserAttributeSelectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_attribute_id' => UserAttribute::factory(),
            'attribute_option_id' => AttributeDefinitionOption::factory(),
        ];
    }
}
