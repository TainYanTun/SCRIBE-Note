<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Note $note)
    {
        Gate::authorize('comment', $note);

        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->content = $validated['content'];
        $comment->user_id = Auth::id();
        $note->comments()->save($comment);

        return back()->with('status', 'Comment added successfully!');
    }
}
