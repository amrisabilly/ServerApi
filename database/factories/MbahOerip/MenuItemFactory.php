<?php

namespace Database\Factories\MbahOerip;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuItem>
 */
class MenuItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Menu ' . $this->faker->words(2, true),
            'description' => $this->faker->sentence(12),
            // Membuat harga acak kelipatan 1000 (antara 15rb - 150rb)
            'price' => $this->faker->numberBetween(15, 150) * 1000,
            // Menggunakan placeholder gambar makanan acak dari loremflickr
            'image_url' => 'https://loremflickr.com/640/480/food,chicken?random=' . $this->faker->numberBetween(1, 100),
        ];
        // Catatan: 'category_id' tidak kita definisikan di sini
        // karena akan lebih mudah diatribusikan saat memanggil factory di Seeder.
    }
}
