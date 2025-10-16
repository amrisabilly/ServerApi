<?php

namespace Database\Seeders\AplikasiCoffe;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\AplikasiCoffe\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'full_name' => 'Admin Coffe',
            'email' => 'admin@coffe.com',
            'password' => Hash::make('password123'),
            'auth_provider' => 'local',
            'provider_id' => null,
            'email_verified_at' => now(),
        ]);
    }
}
