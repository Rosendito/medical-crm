<?php

namespace Database\Seeders\Features;

use App\Models\User;
use App\Models\Users\UserAddress;
use Illuminate\Database\Seeder;

class RotateEncryptedAttributesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->count(100)
            ->has(UserAddress::factory()->count(3))
            ->create();
    }
}
