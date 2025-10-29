<?php

namespace App\Http\Controllers\Api\Bencana;

use App\Http\Controllers\Controller;
use App\Models\Bencana\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengguna = Pengguna::all();
        return response()->json($pengguna);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:pengguna',
            'password' => 'required|string|min:3',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']); // Hash password menggunakan Hash::make

        $pengguna = Pengguna::create($validatedData);

        return response()->json($pengguna, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengguna = Pengguna::findOrFail($id);
        return response()->json($pengguna);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pengguna = Pengguna::findOrFail($id);

        $validatedData = $request->validate([
            'nama_lengkap' => 'sometimes|required|string|max:255',
            'username' => 'sometimes|required|string|max:255|unique:pengguna,username,' . $id,
            'password' => 'sometimes|required|string|min:3',
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']); // Hash password menggunakan Hash::make
        }

        $pengguna->update($validatedData);

        return response()->json($pengguna);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $pengguna->delete();

        return response()->json(['message' => 'Pengguna deleted successfully']);
    }
}