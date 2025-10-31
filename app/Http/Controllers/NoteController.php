<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\Facade\Pdf;
use League\CommonMark\CommonMarkConverter;
use Illuminate\Support\Facades\Log;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Note::class);

        $ownedNotes = $request->user()->notes()->latest()->get();
        $sharedNotes = $request->user()->sharedNotes()->with('user')->latest()->get();

        $notes = $ownedNotes->merge($sharedNotes)->sortByDesc('created_at');

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
        $folders = $user->folders()->get();
        return view('notes.create', [
            'notes' => $notes,
            'tags' => $tags,
            'folders' => $folders,
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
            'folder_id' => 'nullable|integer|exists:folders,id',
        ]);

        $note = $request->user()->notes()->create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'] ?? '',
            'folder_id' => $validated['folder_id'] ?? null,
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
        $folders = $user->folders()->get();

        return view('notes.edit', [
            'note' => $note,
            'allNotes' => $allNotes,
            'linkedNotes' => $linkedNotes,
            'allTags' => $allTags,
            'noteTags' => $noteTags,
            'folders' => $folders,
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
            'folder_id' => 'nullable|integer|exists:folders,id',
            'version' => 'required|integer',
        ]);

        // Optimistic Locking Check
        Log::info('Note Update: Request Version: ' . $request->input('version') . ', DB Version: ' . $note->version);
        if ($request->input('version') != $note->version) {
            Log::warning('Optimistic Locking Conflict for Note ID: ' . $note->id . '. Request Version: ' . $request->input('version') . ', DB Version: ' . $note->version);
            return redirect()->back()->withErrors(['version' => 'This note has been updated by someone else. Please copy your changes, refresh the page to get the latest version, and then re-apply them.'])->withInput();
        }

        $note->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'] ?? '',
            'folder_id' => $validated['folder_id'] ?? null,
        ]);
        Log::info('Note ID: ' . $note->id . ' Version before increment: ' . $note->version);
        $note->increment('version'); // Increment the version using Eloquent's increment method
        Log::info('Note ID: ' . $note->id . ' Version after increment: ' . $note->version);

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
        $tags = $request->query('tags', []);
        $dateStart = $request->query('date_start');
        $dateEnd = $request->query('date_end');
        $sortBy = $request->query('sort_by', 'latest'); // Default sort by latest
        $sortOrder = $request->query('sort_order', 'desc'); // Default sort order desc

        $notesQuery = Note::where('user_id', auth()->id());

        if ($search) {
            $notesQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if (!empty($tags)) {
            $notesQuery->whereHas('tags', function ($query) use ($tags) {
                $query->whereIn('tags.id', $tags);
            });
        }

        if ($dateStart) {
            $notesQuery->whereDate('created_at', '>=', $dateStart);
        }

        if ($dateEnd) {
            $notesQuery->whereDate('created_at', '<=', $dateEnd);
        }

        // Apply sorting
        if ($sortBy === 'latest') {
            $notesQuery->latest();
        } elseif ($sortBy === 'oldest') {
            $notesQuery->oldest();
        } elseif ($sortBy === 'title') {
            $notesQuery->orderBy('title', $sortOrder);
        } elseif ($sortBy === 'updated_at') {
            $notesQuery->orderBy('updated_at', $sortOrder);
        }

        $notes = $notesQuery->paginate(10);
        $allTags = Tag::all(); // Fetch all available tags

        return view('notes.search', [
            'notes' => $notes,
            'search' => $search,
            'allTags' => $allTags,
            'selectedTags' => $tags,
            'dateStart' => $dateStart,
            'dateEnd' => $dateEnd,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
        ]);
    }

    public function toggleTag(Request $request, Note $note)
    {
        Gate::authorize('update', $note);

        $validated = $request->validate([
            'tag' => 'required|string',
        ]);

        $tagName = $validated['tag'];

                $tag = Tag::firstOrCreate(
            ['name' => $tagName, 'user_id' => auth()->id()],
            ['slug' => Str::slug($tagName)]
        );

        $note->tags()->toggle($tag);

        return back();
    }

    public function export(Note $note)
    {
        Gate::authorize('view', $note);

        $converter = new \League\CommonMark\CommonMarkConverter();
        $htmlContent = $converter->convert($note->content);

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('notes.export', [
            'note' => $note,
            'htmlContent' => $htmlContent,
        ]);
        return $pdf->download($note->slug . '.pdf');
    }

    public function share(Note $note)
    {
        Gate::authorize('share', $note);

        return view('notes.share', ['note' => $note]);
    }

    public function processShare(Request $request, Note $note)
    {
        Gate::authorize('share', $note);

        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
            'permission' => 'required|in:view,comment,edit',
        ]);

        $userToShareWith = User::where('email', $validated['email'])->first();

        if (!$userToShareWith) {
            return back()->withErrors(['email' => 'User with this email not found.']);
        }

        // Prevent sharing with self
        if ($userToShareWith->id === Auth::id()) {
            return back()->withErrors(['email' => 'You cannot share a note with yourself.']);
        }

        // Attach the note to the user with the specified permission
        $note->sharedWithUsers()->syncWithoutDetaching([$userToShareWith->id => ['permission' => $validated['permission']]]);

        return redirect()->route('notes.show', $note)->with('status', 'Note shared successfully!');
    }
}