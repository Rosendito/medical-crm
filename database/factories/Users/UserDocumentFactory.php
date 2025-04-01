<?php

namespace Database\Factories\Users;

use App\Models\Identities\DocumentType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users\UserDocument>
 */
class UserDocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'document_type_id' => DocumentType::factory(),
            'number' => strtoupper(fake()->bothify('??######')),
            'issued_by' => fake()->company(),
            'is_verified' => fake()->boolean(),
            'issued_at' => fake()->date(),
            'expires_at' => fake()->optional()->date(),
        ];
    }
}
