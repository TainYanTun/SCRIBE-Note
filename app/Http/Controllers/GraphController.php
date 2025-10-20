<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GraphController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $notes = $user->notes()->with('tags')->get();
        $noteLinks = $user->noteLinks()->get();
        $allTags = $user->tags()->get();

        $notes_data = $notes->map(function($note) {
            return [
                'id' => $note->id,
                'label' => $note->title,
                'tags' => $note->tags->pluck('name')->toArray(),
            ];
        });

        $edges_data = $noteLinks->map(function($link) {
            return ['from' => $link->source_note_id, 'to' => $link->target_note_id];
        });

        $message = '';
        if ($edges_data->isEmpty()) {
            $message = 'No links found between your notes. To create a link, edit a note and select other notes to link to in the "Linked Notes" section.';
        }

        return view('graph.index', [
            'notes_json' => $notes_data->toJson(),
            'edges_json' => $edges_data->toJson(),
            'all_tags_json' => $allTags->toJson(),
            'message' => $message,
        ]);
    }
}
