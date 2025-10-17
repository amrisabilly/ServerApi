<?php

namespace Database\Seeders\AplikasiCoffe;

use Illuminate\Database\Seeder;
use App\Models\AplikasiCoffe\Categories;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        Categories::factory()->count(10)->create();
    }
}
