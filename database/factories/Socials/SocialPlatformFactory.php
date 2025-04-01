<?php

namespace Database\Factories\Socials;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Socials\SocialPlatform>
 */
class SocialPlatformFactory extends Factory
{
    protected array $socials = [
        'facebook' => [
            'name' => 'Facebook',
            'base_url' => 'https://facebook.com/',
        ],
        'twitter' => [
            'name' => 'Twitter',
            'base_url' => 'https://twitter.com/',
        ],
        'linkedin' => [
            'name' => 'LinkedIn',
            'base_url' => 'https://linkedin.com/in/',
        ],
        'github' => [
            'name' => 'GitHub',
            'base_url' => 'https://github.com/',
        ],
        'instagram' => [
            'name' => 'Instagram',
            'base_url' => 'https://instagram.com/',
        ],
        'tiktok' => [
            'name' => 'TikTok',
            'base_url' => 'https://tiktok.com/@',
        ],
        'youtube' => [
            'name' => 'YouTube',
            'base_url' => 'https://youtube.com/@',
        ],
        'website' => [
            'name' => 'Website',
            'base_url' => '',
        ],
        'other' => [
            'name' => 'Other',
            'base_url' => '',
        ],
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $code = fake()->randomElement(array_keys($this->socials));
        $platform = $this->socials[$code];

        return [
            'name' => $platform['name'],
            'code' => $code,
            'base_url' => $platform['base_url'],
            'regex_pattern' => null,
        ];
    }
}
