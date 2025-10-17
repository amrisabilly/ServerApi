<?php

namespace Database\Seeders\AplikasiCoffe;

use Illuminate\Database\Seeder;
use App\Models\AplikasiCoffe\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Product::create([
                'category_id' => ($i % 2) + 1, // ganti sesuai jumlah kategori yang ada
                'name' => 'Product ' . $i,
                'description' => 'Deskripsi produk ke-' . $i,
                'origin_story' => 'Asal usul produk ke-' . $i,
                'price' => rand(50000, 150000),
                'image_url' => 'https://tse4.mm.bing.net/th/id/OIP.nyCUkf0GY8ueelkMm_deIQHaHD?pid=Api&P=0&h=180',
            ]);
        }
    }
}