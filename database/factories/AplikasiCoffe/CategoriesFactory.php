<?php

namespace Database\Factories\AplikasiCoffe;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AplikasiCoffe\Categories;

class CategoriesFactory extends Factory
{
    protected $model = Categories::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Arabica Premium',
                'Robusta Special',
                'Liberica Rare',
                'Excelsa Blend',
                'Java Estate',
                'Sumatra Mandheling',
                'Toraja Highland',
                'Kintamani Bali',
                'Gayo Mountain',
                'Flores Bajawa'
            ]),
            'description' => $this->faker->text(100),
        ];
    }
}
