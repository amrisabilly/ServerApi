<?php

namespace App\Http\Controllers\Api\AplikasiCoffe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AplikasiCoffe\Categories;

class CategoriesController extends Controller
{
    public function index()
    {
        return response()->json(Categories::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'url_foto' => 'nullable',
        ]);
        $category = Categories::create($data);
        return response()->json($category, 201);
    }

    public function show($id)
    {
        $category = Categories::findOrFail($id);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $category = Categories::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|unique:table_categories,name,' . $id,
            'description' => 'nullable|string',
            'url_foto' => 'nullable|string|max:255',
        ]);
        $category->update($data);
        return response()->json($category);
    }

    public function destroy($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();
        return response()->json(['message' => 'Category deleted']);
    }
}
