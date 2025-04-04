<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tenant = Tenant::factory()->create([
            'name' => 'MedicalCRM',
            'slug' => 'medical-crm',
        ]);

        User::factory()->create([
            'tenant_id' => $tenant->id,
            'first_name' => 'Admin',
            'last_name' => 'MedicalCRM',
            'email' => 'admin@medicalcrm.com',
        ]);
    }
}
