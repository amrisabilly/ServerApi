<?php

namespace App\Http\Controllers\Api\AplikasiCoffe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AplikasiCoffe\Favourites;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Favourites::with(['user', 'product'])->get());
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
        $data = $request->validate([
            'user_id' => 'required|exists:table_user,id',
            'product_id' => 'required|exists:product,id',
        ]);

        // Cegah duplikasi favourite
        $favourite = Favourites::firstOrCreate($data);

        return response()->json($favourite->load(['user', 'product']), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $favourite = Favourites::with(['user', 'product'])->findOrFail($id);
        return response()->json($favourite);
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
        $favourite = Favourites::findOrFail($id);

        $data = $request->validate([
            'user_id' => 'sometimes|exists:table_user,id',
            'product_id' => 'sometimes|exists:product,id',
        ]);

        $favourite->update($data);

        return response()->json($favourite->load(['user', 'product']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $favourite = Favourites::findOrFail($id);
        $favourite->delete();
        return response()->json(['message' => 'Favourite deleted']);
    }
}
