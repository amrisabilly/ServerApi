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
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx,txt|max:2048',
            'file_name' => 'nullable|string',
            'file_size' => 'nullable|integer',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('', $filename, 'public'); // simpan di root public
            $data['file_name'] = $filename;
            $data['file_size'] = $file->getSize();
        }

        $message = MessagesKriptografi::create($data);

        return response()->json($message, 201);
    }

    // List pesan untuk user tertentu
    public function index(Request $request)
    {
        if ($request->has('user_id')) {
            $userId = $request->query('user_id');
            $messages = MessagesKriptografi::where('recipient_id', $userId)
                ->orWhere('sender_id', $userId)
                ->get();
        } else {
            $messages = MessagesKriptografi::all();
        }
        return response()->json($messages);
    }

    // Show detail pesan
    public function show($id)
    {
        $message = MessagesKriptografi::findOrFail($id);
        return response()->json($message);
    }
}
