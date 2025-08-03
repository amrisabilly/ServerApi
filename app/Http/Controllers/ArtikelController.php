<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jorenvh\Share\ShareFacade as Share;
use Illuminate\Support\Str;

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
        $article = $this->getArticleById($id);

        if (!$article) {
            abort(404);
        }

        // Custom share URLs dengan gambar dan judul
        $currentUrl = request()->fullUrl();
        $imageUrl = asset('artikel/' . $article['image']);
        $title = $article['title'];
        $description = Str::limit($article['content'], 100);

        $shareButtons = [
            'facebook' => "https://www.facebook.com/sharer/sharer.php?u=" . urlencode($currentUrl) . "&t=" . urlencode($title),
            'twitter' => "https://twitter.com/intent/tweet?url=" . urlencode($currentUrl) . "&text=" . urlencode($title . " - " . $description),
            'linkedin' => "https://www.linkedin.com/sharing/share-offsite/?url=" . urlencode($currentUrl),
            'whatsapp' => "https://wa.me/?text=" . urlencode($title . " - " . $currentUrl),
            'telegram' => "https://t.me/share/url?url=" . urlencode($currentUrl) . "&text=" . urlencode($title)
        ];

        return view('artikel.detail', compact('article', 'shareButtons'));
    }

    private function getArticleById($id)
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

        return $article;
    }
}
