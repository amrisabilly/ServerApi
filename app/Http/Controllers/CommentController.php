<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'name' => 'required|string|max:100',
            'comment' => 'required|string|max:1000',
        ]);

        // Simpan komentar
        $comment = Comment::create([
            'article_id' => $validated['article_id'],
            'name' => $validated['name'],
            'comment' => $validated['comment'],
        ]);

        // Response JSON untuk AJAX, tambahkan created_at
        return response()->json([
            'success' => true,
            'comment' => [
                'name' => $comment->name,
                'comment' => $comment->comment,
                'created_at' => $comment->created_at->diffForHumans(),
            ]
        ]);
    }

    public function reply(Request $request)
    {
        $validated = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'parent_id' => 'required|exists:comments,id',
            'name' => 'required|string|max:255',
            'comment' => 'required|string',
        ]);

        $reply = new \App\Models\Comment();
        $reply->article_id = $validated['article_id'];
        $reply->parent_id = $validated['parent_id'];
        $reply->name = $validated['name'];
        $reply->comment = $validated['comment'];
        $reply->save();

        return response()->json([
            'success' => true,
            'comment' => [
                'id' => $reply->id,
                'name' => $reply->name,
                'comment' => $reply->comment,
                'created_at' => $reply->created_at->diffForHumans(),
            ]
        ]);
    }
}
