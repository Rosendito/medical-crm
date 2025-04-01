<?php

namespace Database\Factories\Users;

use App\Models\Socials\SocialPlatform;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users\UserSocialProfile>
 */
class UserSocialProfileFactory extends Factory
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
            'social_platform_id' => SocialPlatform::factory(),
            'handle' => '@'.fake()->userName(),
            'url' => fake()->url(),
            'is_primary' => fake()->boolean(80),
        ];
    }
}
