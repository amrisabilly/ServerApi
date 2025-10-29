<?php

namespace Database\Seeders\Bencana;

use Illuminate\Database\Seeder;
use App\Models\Bencana\Pengguna;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengguna::create([
            'nama_lengkap' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('password123'), // Hash password menggunakan Hash::make
        ]);

        Pengguna::create([
            'nama_lengkap' => 'bima',
            'username' => '123',
            'password' => Hash::make('password123'), // Hash password menggunakan Hash::make
        ]);
    }
}