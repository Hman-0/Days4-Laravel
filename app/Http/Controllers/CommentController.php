<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|string',
        ]);

        $comment = Comment::create([
            'content' => $validated['content'],
            'commentable_id' => $validated['commentable_id'],
            'commentable_type' => $validated['commentable_type'],
            'user_id' => 1  // For testing without auth
        ]);

        return back()->with('success', 'Comment added successfully');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comment deleted successfully');
    }
}