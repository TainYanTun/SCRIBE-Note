<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TagController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        // $this->authorizeResource(Tag::class, 'tag');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Tag::class);

        $user = auth()->user();
        $specialTagNames = ['favorite', 'important', 'todo'];

        // Fetch special tags first
        $specialTags = $user->tags()
                            ->whereIn('name', $specialTagNames)
                            ->select('id', 'name', 'slug', 'description', 'user_id') // Explicitly select description
                            ->withCount(['notes' => function ($query) use ($user) {
                                $query->where('user_id', $user->id);
                            }])
                            ->get();

        // Fetch other tags, excluding special tags
        $otherTags = $user->tags()
                          ->whereNotIn('name', $specialTagNames)
                          ->select('id', 'name', 'slug', 'description', 'user_id') // Explicitly select description
                          ->withCount(['notes' => function ($query) use ($user) {
                              $query->where('user_id', $user->id);
                          }])
                          ->latest()
                          ->get();

        // Combine and sort: special tags first, then other tags by latest
        $tags = $specialTags->merge($otherTags)->sortBy(function ($tag) use ($specialTagNames) {
            return array_search($tag->name, $specialTagNames) !== false ? array_search($tag->name, $specialTagNames) : PHP_INT_MAX;
        });

        return view('tags.index', ['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Tag::class);
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Tag::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,NULL,id,user_id,' . auth()->id(),
            'description' => 'nullable|string|max:255',
        ]);

        auth()->user()->tags()->create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'],
        ]);

        return redirect()->route('tags.index')->with('status', 'Tag created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        $this->authorize('view', $tag);
        $notes = $tag->notes()->where('user_id', auth()->id())->latest()->paginate(10);
        return view('tags.show', compact('tag', 'notes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        $this->authorize('update', $tag);
        return view('tags.edit', ['tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $this->authorize('update', $tag);

        $specialTags = ['favorite', 'important', 'todo'];
        if (in_array($tag->name, $specialTags)) {
            return redirect()->route('tags.index')->with('error', 'You cannot modify a special tag.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id . ',id,user_id,' . auth()->id(),
            'description' => 'nullable|string|max:255',
        ]);

        $tag->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'],
        ]);

        return redirect()->route('tags.index')->with('status', 'Tag updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $this->authorize('delete', $tag);

        $specialTags = ['favorite', 'important', 'todo'];
        if (in_array($tag->name, $specialTags)) {
            return redirect()->route('tags.index')->with('error', 'You cannot delete a special tag.');
        }

        $tag->delete();

        return redirect()->route('tags.index')->with('status', 'Tag deleted successfully!');
    }
}