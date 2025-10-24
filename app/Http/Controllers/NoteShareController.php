<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class NoteShareController extends Controller
{
    public function create(Note $note)
    {
        Gate::authorize('update', $note);

        return view('notes.share', compact('note'));
    }

    public function store(Request $request, Note $note)
    {
        Gate::authorize('update', $note);

        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
            'permission' => 'required|string|in:view,comment,edit',
        ]);

        $userToShareWith = User::where('email', $validated['email'])->first();

        if ($userToShareWith->id === $note->user_id) {
            return back()->with('error', 'You cannot share a note with its owner.');
        }

        $note->sharedWithUsers()->syncWithoutDetaching([
            $userToShareWith->id => ['permission' => $validated['permission']],
        ]);

        return back()->with('status', 'Note shared successfully!');
    }

    public function update(Request $request, Note $note, User $user)
    {
        Gate::authorize('update', $note);

        $validated = $request->validate([
            'permission' => 'required|string|in:view,comment,edit',
        ]);

        $note->sharedWithUsers()->updateExistingPivot($user->id, [
            'permission' => $validated['permission'],
        ]);

        return back()->with('status', 'Permission updated successfully!');
    }

    public function destroy(Note $note, User $user)
    {
        Gate::authorize('update', $note);

        $note->sharedWithUsers()->detach($user->id);

        return back()->with('status', 'User removed from note successfully!');
    }
}