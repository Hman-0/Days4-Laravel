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
            'content' => 'required|string|max:500',
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|string',
            'user_id' => 'required|exists:users,id'
        ]);

        $comment = $validated['commentable_type']::findOrFail($validated['commentable_id'])
            ->comments()
            ->create($validated);

        return back()->with('success', 'Bình luận đã được đăng thành công');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comment deleted successfully');
    }
}