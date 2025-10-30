<?php

namespace App\Http\Controllers\Api\AplikasiCoffe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AplikasiCoffe\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Tambahkan eager loading untuk ratings dan favouritedBy
        return response()->json(Product::with(['category', 'ratings', 'favouritedBy'])->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:table_categories,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'origin_story' => 'nullable|string',
            'price' => 'required|numeric',
            'image_url' => 'nullable|string',
        ]);
        $product = Product::create($data);
        return response()->json($product->load(['category', 'ratings', 'favouritedBy']), 201);
    }

    public function show($id)
    {
        $product = Product::with(['category', 'ratings', 'favouritedBy'])->findOrFail($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validate([
            'category_id' => 'required|exists:table_categories,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'origin_story' => 'nullable|string',
            'price' => 'required|numeric',
            'image_url' => 'nullable|string',
        ]);
        $product->update($data);
        return response()->json($product->load(['category', 'ratings', 'favouritedBy']));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }
}
