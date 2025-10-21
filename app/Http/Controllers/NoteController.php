<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Note::class);

        $notes = $request->user()->notes()->latest()->get();

        $groupedNotes = $notes->groupBy(function ($note) {
            return $note->created_at->format('Y-m-d');
        });

        return view('notes.index', compact('groupedNotes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Note::class);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $notes = $user->notes()->latest()->get();
        $tags = Tag::all(); // Fetch all available tags
        return view('notes.create', [
            'notes' => $notes,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Note::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'linked_notes' => 'nullable|array',
            'linked_notes.*' => 'integer|exists:notes,id',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tags,id',
        ]);

        $note = $request->user()->notes()->create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'] ?? '',
        ]);

        if (isset($validated['linked_notes'])) {
            $note->linkedNotes()->sync($validated['linked_notes']);
        }

        if (isset($validated['tags'])) {
            $note->tags()->sync($validated['tags']);
        }

        return redirect()->route('notes.show', $note)->with('status', 'Note created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        Gate::authorize('view', $note);

        return view('notes.show', ['note' => $note]);
    }

    /**
     * Show the form for editing the specified resource.  
     */
    public function edit(Note $note)
    {
        Gate::authorize('update', $note);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $allNotes = $user->notes()->where('id', '!=', $note->id)->latest()->get();
        $linkedNotes = $note->linkedNotes->pluck('id')->toArray();
        $allTags = Tag::all(); // Fetch all available tags
        $noteTags = $note->tags->pluck('id')->toArray(); // Get IDs of tags currently associated with the note

        return view('notes.edit', [
            'note' => $note,
            'allNotes' => $allNotes,
            'linkedNotes' => $linkedNotes,
            'allTags' => $allTags,
            'noteTags' => $noteTags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        Gate::authorize('update', $note);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'linked_notes' => 'nullable|array',
            'linked_notes.*' => 'integer|exists:notes,id',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tags,id',
        ]);

        $note->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'] ?? '',
        ]);

        if (isset($validated['linked_notes'])) {
            $note->linkedNotes()->sync($validated['linked_notes']);
        }

        if (isset($validated['tags'])) {
            $note->tags()->sync($validated['tags']);
        }

        return redirect()->route('notes.show', $note)->with('status', 'Note updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        Gate::authorize('delete', $note);

        $note->delete();

        return redirect()->route('notes.index')->with('status', 'Note deleted successfully!');
    }

    public function search(Request $request)
    {
        Gate::authorize('viewAny', Note::class);

        $search = $request->query('search');
        $notesQuery = Note::where('user_id', auth()->id());

        if ($search) {
            $notesQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $notes = $notesQuery->latest()->get();

        return view('notes.search', ['notes' => $notes, 'search' => $search]);
    }

    public function toggleTag(Request $request, Note $note)
    {
        Gate::authorize('update', $note);

        $validated = $request->validate([
            'tag' => 'required|string',
        ]);

        $tagName = $validated['tag'];

        $tag = Tag::firstOrCreate(['name' => $tagName, 'slug' => Str::slug($tagName)]);

        $note->tags()->toggle($tag);

        return back();
    }
}