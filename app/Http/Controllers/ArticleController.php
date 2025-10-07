<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        // Ambil semua artikel urut terbaru
        $articles = Article::latest()->get();

        // Kirim ke view
        return view('landing.article.index', compact('articles'));
    }

    /**
     * Tampilkan detail artikel.
     */
   public function show($id)
{
    $article = Article::with('comments')->findOrFail($id);
    return view('landing.article.show', compact('article'));
}
}
