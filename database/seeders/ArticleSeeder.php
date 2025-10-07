<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::create([
            'title'   => 'Belajar Laravel Dasar',
            'content' => 'Laravel adalah framework PHP yang sangat populer untuk membangun aplikasi web modern. Artikel ini membahas dasar-dasar penggunaan Laravel.',
            'author'  => 'Asep',
        ]);

        Article::create([
            'title'   => 'Apa itu Tailwind CSS?',
            'content' => 'Tailwind CSS adalah utility-first CSS framework yang mempermudah pembuatan UI modern dengan cepat.',
            'author'  => 'Budi',
        ]);

        Article::create([
            'title'   => 'Mengenal AJAX di Laravel',
            'content' => 'AJAX memungkinkan kita mengirim dan menerima data dari server tanpa perlu me-reload seluruh halaman.',
            'author'  => 'Citra',
        ]);
    }
}
