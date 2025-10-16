<?php

namespace Database\Seeders\AplikasiCoffe;

use Illuminate\Database\Seeder;
use App\Models\AplikasiCoffe\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'category_id' => 1,
            'name' => 'Arabica Aceh Gayo',
            'description' => 'Kopi Arabica dari Aceh Gayo.',
            'origin_story' => 'Ditanam di dataran tinggi Gayo.',
            'price' => 85000,
            'image_url' => 'https://example.com/arabica-gayo.jpg',
        ]);
        Product::create([
            'category_id' => 2,
            'name' => 'Robusta Lampung',
            'description' => 'Kopi Robusta dari Lampung.',
            'origin_story' => 'Ditanam di Lampung Selatan.',
            'price' => 65000,
            'image_url' => 'https://example.com/robusta-lampung.jpg',
        ]);
    }
}