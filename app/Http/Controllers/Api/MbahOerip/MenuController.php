<?php

namespace App\Http\Controllers\Api\MbahOerip;

use App\Http\Controllers\Controller;
use App\Models\MbahOerip\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MenuController extends Controller
{
    /**
     * Menampilkan semua item menu, beserta kategori-nya.
     * Endpoint: GET /api/menu
     */
    public function index()
    {
        // Ini menggantikan fungsi index() yang lama
        // Sekarang hanya mengembalikan daftar item menu
        return response()->json(MenuItem::with('category')->latest()->get());
    }

    /**
     * Menyimpan item menu baru.
     * Endpoint: POST /api/menu
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            // Pastikan category_id ada di tabel 'categories'
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|string|url', // 'url' untuk validasi link
        ]);

        $menuItem = MenuItem::create($data);
        return response()->json($menuItem, 201);
    }

    /**
     * Menampilkan satu item menu spesifik.
     * Endpoint: GET /api/menu/{id}
     */
    public function show($id)
    {
        $menuItem = MenuItem::with('category')->findOrFail($id);
        return response()->json($menuItem);
    }

    /**
     * Memperbarui item menu.
     * Endpoint: PUT /api/menu/{id}
     */
    public function update(Request $request, $id)
    {
        $menuItem = MenuItem::findOrFail($id);

        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|string|url',
        ]);

        $menuItem->update($data);
        return response()->json($menuItem);
    }

    /**
     * Menghapus item menu.
     * Endpoint: DELETE /api/menu/{id}
     */
    public function destroy($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->delete();

        return response()->json(['message' => 'Menu item berhasil dihapus.']);
    }
}