<?php

namespace App\Http\Controllers\Api\AplikasiCoffe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AplikasiCoffe\Ratings;

class RatingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // List semua rating (beserta user & produk)
        return response()->json(Ratings::with(['user', 'product'])->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Simpan rating baru
        $data = $request->validate([
            'user_id' => 'required|exists:table_user,id',
            'product_id' => 'required|exists:product,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $rating = Ratings::create($data);

        return response()->json($rating->load(['user', 'product']), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Tampilkan detail rating
        $rating = Ratings::with(['user', 'product'])->findOrFail($id);
        return response()->json($rating);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Update rating
        $rating = Ratings::findOrFail($id);

        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $rating->update($data);

        return response()->json($rating->load(['user', 'product']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus rating
        $rating = Ratings::findOrFail($id);
        $rating->delete();
        return response()->json(['message' => 'Rating deleted']);
    }
}
