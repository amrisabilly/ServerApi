<?php

namespace App\Http\Controllers\Api\MbahOerip;

use App\Http\Controllers\Controller;
use App\Models\MbahOerip\Category;
use Illuminate\Http\Request;    

class MenuController extends Controller
{
    public function index()
    {
        // Ambil semua kategori beserta relasi 'menuItems'-nya
        // 'with()' digunakan untuk Eager Loading agar query lebih efisien
        $categories = Category::with('menuItems')->get();

        // Kembalikan data sebagai response JSON
        return response()->json($categories);
    }
}
