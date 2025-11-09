<?php

namespace App\Http\Controllers\Api\Kriptografi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kriptografi\UsersKriptografi;
use Illuminate\Support\Facades\Hash;

class AuthentikasiController extends Controller
{
    // Register user
    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|unique:users_kripto,username',
            'display_name' => 'required|string',
            'email' => 'required|email|unique:users_kripto,email',
            'password' => 'required|string|min:6',
            'public_key' => 'required|string',
            'profile_photo_url' => 'nullable|string',
            'bio' => 'nullable|string',
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = UsersKriptografi::create($data);

        return response()->json(['user' => $user], 201);
    }

    // Login user
    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = UsersKriptografi::where('username', $data['username'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Login gagal'], 401);
        }


        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'user' => $user,
            'token' => $token,
        ]);
    }

    // List semua user
    public function index()
    {
        return response()->json(UsersKriptografi::all());
    }

    // Show detail user
    public function show($id)
    {
        $user = UsersKriptografi::findOrFail($id);
        return response()->json($user);
    }
}
