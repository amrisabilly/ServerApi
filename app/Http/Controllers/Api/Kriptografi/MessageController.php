<?php

namespace App\Http\Controllers\Api\Kriptografi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kriptografi\MessagesKriptografi;

class MessageController extends Controller
{
    // Kirim pesan
    public function store(Request $request)
    {
        $data = $request->validate([
            'sender_id' => 'required|exists:users_kripto,id',
            'recipient_id' => 'required|exists:users_kripto,id',
            'content_type' => 'required|string',
            'encrypted_payload' => 'required|string',
            'file_name' => 'nullable|string',
            'file_size' => 'nullable|integer',
        ]);

        $message = MessagesKriptografi::create($data);

        return response()->json($message, 201);
    }

    // List pesan untuk user tertentu
    public function index(Request $request)
    {
        $userId = $request->query('user_id');
        $messages = MessagesKriptografi::where('recipient_id', $userId)
            ->orWhere('sender_id', $userId)
            ->get();

        return response()->json($messages);
    }

    // Show detail pesan
    public function show($id)
    {
        $message = MessagesKriptografi::findOrFail($id);
        return response()->json($message);
    }
}
