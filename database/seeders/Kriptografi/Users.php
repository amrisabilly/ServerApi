<?php

namespace Database\Seeders\Kriptografi;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users_kripto')->insert([
            [
                'username' => 'amri',
                'display_name' => Crypt::encryptString('Amri Sabilly'),
                'email' => Crypt::encryptString('amri@example.com'),
                'password' => Hash::make('password123'),
                'public_key' => Str::random(32),
                'profile_photo_url' => 'https://example.com/photo1.jpg',
                'bio' => Crypt::encryptString('Pengguna pertama aplikasi kriptografi.'),
            ],
        ]);
    }
}
