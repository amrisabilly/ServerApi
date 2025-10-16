<?php

namespace Database\Seeders\AplikasiCoffe;

use Illuminate\Database\Seeder;
use App\Models\AplikasiCoffe\Categories;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        Categories::create([
            'name' => 'Arabica',
            'description' => 'Kopi Arabica dengan cita rasa khas.',
        ]);
        Categories::create([
            'name' => 'Robusta',
            'description' => 'Kopi Robusta dengan rasa kuat.',
        ]);
    }
}