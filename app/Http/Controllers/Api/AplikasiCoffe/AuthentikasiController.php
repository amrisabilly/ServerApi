<?php

namespace App\Http\Controllers\Api\AplikasiCoffe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AplikasiCoffe\User;
use Illuminate\Support\Facades\Hash;

class AuthentikasiController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:table_user,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['user' => $user], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Login gagal'], 401);
        }

        $token = auth('api')->login($user);

        return response()->json([
            'message' => 'Login berhasil',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function index()
    {
        return response()->json(User::all());
    }
}
