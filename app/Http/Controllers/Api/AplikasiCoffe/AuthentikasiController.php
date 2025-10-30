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
            'user' => $user->load(['orders', 'ratings', 'favourites']),
            'token' => $token,
        ]);
    }

    public function index()
    {
        return response()->json(User::with(['orders', 'ratings', 'favourites'])->get());
    }

    public function uploadPhoto(Request $request)
    {
        $user = User::find(auth('api')->id());

        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('', $filename);
            $url = asset('storage/' . $filename);

            $user->photo_url = $url;
            $user->save();

            return response()->json(['photo_url' => $url, 'user' => $user]);
        }

        return response()->json(['error' => 'Upload gagal'], 400);
    }

    public function addPoint(Request $request)
    {
        $user = User::find(auth('api')->id());
        $request->validate([
            'points' => 'sometimes|integer|min:1', // opsional, default 1
        ]);
        $add = $request->points ?? 1;
        $user->points += $add;
        $user->save();

        return response()->json([
            'message' => 'Poin berhasil ditambahkan',
            'points' => $user->points,
            'user' => $user
        ]);
    }

    public function redeemPoints(Request $request)
    {
        $user = User::find(auth('api')->id());
        $request->validate([
            'points' => 'required|integer|min:1',
        ]);
        $redeem = $request->points;

        if ($user->points < $redeem) {
            return response()->json(['message' => 'Poin tidak cukup'], 400);
        }

        $user->points -= $redeem;
        $user->save();

        // Di sini Anda bisa menambahkan logika pemberian diskon, dsb.

        return response()->json([
            'message' => 'Poin berhasil ditukar',
            'points' => $user->points,
            'user' => $user
        ]);
    }
}
