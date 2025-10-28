<?php

namespace App\Http\Controllers\Api\MbahOerip;

use App\Http\Controllers\Controller;
use App\Models\MbahOerip\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Menampilkan semua kategori.
     * Endpoint: GET /api/categories
     */
    public function index()
    {
        // bisa juga gunakan Category::all()
        // Menggunakan 'latest()' agar data terbaru di atas
        return response()->json(Category::latest()->get());
    }

    /**
     * Menyimpan kategori baru.
     * Endpoint: POST /api/categories
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            // Validasi ke tabel 'categories', kolom 'name'
            'name' => 'required|string|unique:categories,name', 
        ]);

        $category = Category::create($data);
        return response()->json(
            $category, 201); // 201 = Created
    }

    /**
     * Menampilkan satu kategori spesifik.
     * Endpoint: GET /api/categories/{id}
     */
    public function show($id)
    {
        // findOrFail akan otomatis memberi 404 jika tidak ditemukan
        $category = Category::findOrFail($id); 
        return response()->json($category);
    }

    /**
     * Memperbarui kategori yang ada.
     * Endpoint: PUT /api/categories/{id}
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $data = $request->validate([
            'name' => [
                'required',
                'string',
                // Pastikan 'name' unik, KECUALI untuk ID kategori ini sendiri
                Rule::unique('categories')->ignore($category->id),
            ],
        ]);

        $category->update($data);
        return response()->json($category);
    }

    /**
     * Menghapus kategori.
     * Endpoint: DELETE /api/categories/{id}
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        
        // 200 OK dengan pesan konfirmasi
        return response()->json(['message' => 'Kategori berhasil dihapus.']);
    }
}