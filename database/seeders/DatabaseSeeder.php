<?php

namespace Database\Seeders;

use App\Models\AplikasiCoffe\Orders;
use Illuminate\Database\Seeder;
use Database\Seeders\AplikasiCoffe\UserSeeder;
use Database\Seeders\AplikasiCoffe\CategoriesSeeder;
use Database\Seeders\AplikasiCoffe\ProductSeeder;
use Database\Seeders\MbahOerip\CategorySeeder;
use Database\Seeders\MbahOerip\MenuItemSeeder;
use Database\Seeders\Bencana\PenggunaSeeder;
use Database\Seeders\AplikasiCoffe\OrdersSeeder;
use Database\Seeders\AplikasiCoffe\OrderItemsSeeder;

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
            OrdersSeeder::class,
            OrderItemsSeeder::class,
        ]);
        $this->call([
            CategorySeeder::class,
            MenuItemSeeder::class,
        ]);

        // Bencana
        $this->call([
            PenggunaSeeder::class,
        ]);
    }
}
