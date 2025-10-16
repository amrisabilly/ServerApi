<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AplikasiCoffe\UserSeeder;
use Database\Seeders\AplikasiCoffe\CategoriesSeeder;
use Database\Seeders\AplikasiCoffe\ProductSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategoriesSeeder::class,
            ProductSeeder::class,
        ]);
    }
}