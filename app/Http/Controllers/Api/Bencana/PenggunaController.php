<?php

namespace App\Http\Controllers\Api\Bencana;

use App\Http\Controllers\Controller;
use App\Models\Bencana\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengguna = Pengguna::all();
        return response()->json($pengguna, 200);
    }

    // Login method
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari pengguna berdasarkan username
        $pengguna = Pengguna::where('username', $validatedData['username'])->first();

        if (!$pengguna || !Hash::check($validatedData['password'], $pengguna->password)) {
            return response()->json(['message' => 'Username atau password salah'], 401);
        }

        // Jika login berhasil, kembalikan data pengguna
        return response()->json([
            'id' => $pengguna->id,
            'nama_lengkap' => $pengguna->nama_lengkap,
            'username' => $pengguna->username,
            'created_at' => $pengguna->created_at,
            'updated_at' => $pengguna->updated_at,
        ], 200);
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

    // foto
    public function uploadPhoto(Request $request, string $id)
    {
        $pengguna = Pengguna::findOrFail($id);

        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($pengguna->url_foto) {
                $oldPhotoPath = str_replace(asset('storage/'), '', $pengguna->url_foto);
                if (Storage::disk('public')->exists($oldPhotoPath)) {
                    Storage::disk('public')->delete($oldPhotoPath);
                }
            }

            $file = $request->file('photo');
            $filename = 'pengguna_' . $pengguna->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            
            // Simpan ke storage/app/public/photos
            $path = $file->storeAs('photos', $filename, 'public');
            $url = asset('storage/' . $path);

            // Update kolom url_foto di database
            $pengguna->url_foto = $url;
            $pengguna->save();

            return response()->json([
                'message' => 'Photo uploaded successfully',
                'photo_url' => $url, 
                'pengguna' => $pengguna
            ], 200);
        }

        return response()->json(['error' => 'Upload gagal'], 400);
    }

}
