<?php

namespace Database\Seeders\MbahOerip;

use App\Models\MbahOerip\Category;
use App\Models\MbahOerip\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Dapatkan jumlah kategori yang ada di database secara dinamis
        $categoryCount = Category::count();

        // Jika tidak ada kategori, hentikan seeder untuk menghindari error
        if ($categoryCount == 0) {
            $this->command->info('Tidak ada kategori. Silakan jalankan CategorySeeder terlebih dahulu.');
            return;
        }

        // 2. Lakukan perulangan untuk membuat, misalnya, 30 item menu
        for ($i = 1; $i <= 30; $i++) {
            MenuItem::create([
                // 3. Atribusikan category_id secara bergiliran (1, 2, 3, 4, 1, 2, ...)
                'category_id' => ($i % $categoryCount) + 1,
                'name' => 'Menu Spesial ' . $i,
                'description' => 'Deskripsi lezat untuk menu spesial ke-' . $i,

                // 4. Buat harga acak antara 10rb sampai 120rb
                'price' => rand(10, 120) * 1000,

                // 5. Gunakan gambar placeholder yang dinamis
                'image_url' => 'https://loremflickr.com/640/480/food,restaurant?random=' . $i,
            ]);
        }
    }
}
