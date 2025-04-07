<?php

namespace Database\Factories\Users;

use App\Enums\Models\Users\UserContactType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users\UserContact>
 */
class UserContactFactory extends Factory
{
    protected array $phoneLabels = [
        'Personal',
        'House',
        'Whatsapp',
        'Telegram',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(UserContactType::cases());

        return tenant_columns([
            'user_id' => User::factory(),
            'type' => $type,
            'value' => $type === UserContactType::EMAIL
                ? fake()->unique()->safeEmail()
                : fake()->unique()->e164PhoneNumber(),
            'label' => $type === UserContactType::EMAIL
                ? 'Email'
                : fake()->randomElement($this->phoneLabels),
            'is_primary' => fake()->boolean(30),
            'verified_at' => fake()->optional()->dateTime(),
        ]);
    }
}
