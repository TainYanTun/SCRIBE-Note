<?php

namespace App\Http\Controllers;

use App\Models\NoteInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class NoteInvitationController extends Controller
{
    public function accept(Request $request, string $token)
    {
        if (! URL::hasValidSignature($request)) {
            return redirect()->route('dashboard')->with('error', 'Invalid or expired invitation link.');
        }

        $invitation = NoteInvitation::where('token', $token)->firstOrFail();

        if ($invitation->expires_at && $invitation->expires_at->isPast()) {
            return redirect()->route('dashboard')->with('error', 'Invitation has expired.');
        }

        if ($invitation->accepted_at) {
            return redirect()->route('notes.show', $invitation->note)->with('status', 'You have already accepted this invitation.');
        }

        // Ensure the invited user is logged in and matches the invitation
        if (! Auth::check() || Auth::id() !== $invitation->invited_user_id) {
            // Redirect to login with an intended URL to accept the invitation after login
            return redirect()->route('login')->with('status', 'Please log in to accept the invitation.');
        }

        $note = $invitation->note;
        $user = $invitation->invitedUser;

        // Attach the user to the note with the given permission
        $note->sharedWithUsers()->syncWithoutDetaching([
            $user->id => ['permission' => $invitation->permission],
        ]);

        $invitation->update([
            'accepted_at' => now(),
        ]);

        return redirect()->route('notes.show', $note)->with('status', 'Note invitation accepted!');
    }
}
