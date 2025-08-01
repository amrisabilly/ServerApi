<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        $jsonPath = public_path('artikel/dataArtikel.json');
        $data = json_decode(file_get_contents($jsonPath), true);

        return view('welcome', compact('data'));
    }

    public function show($id)
    {
        $jsonPath = public_path('artikel/dataArtikel.json');
        $data = json_decode(file_get_contents($jsonPath), true);

        $article = null;
        foreach ($data['categories'] as $category => $articles) {
            foreach ($articles as $art) {
                if ($art['id'] == $id) {
                    $article = $art;
                    $article['category'] = $category;
                    break 2;
                }
            }
        }

        if (!$article) {
            abort(404);
        }

        return view('artikel.detail', compact('article'));
    }
}
