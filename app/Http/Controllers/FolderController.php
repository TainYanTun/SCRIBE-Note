<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Note;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    use AuthorizesRequests;

    public function index(Folder $folder = null)
    {
        if ($folder) {
            $this->authorize('view', $folder);
            $folders = $folder->children;
            $notes = $folder->notes;
        } else {
            $folders = auth()->user()->folders()->whereNull('parent_id')->get();
            $notes = collect(); // Empty collection for notes at the root level
        }

        return view('folders.index', [
            'folder' => $folder,
            'folders' => $folders,
            'notes' => $notes,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Folder::class);

        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:folders,id',
        ]);

        $folder = Folder::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'user_id' => auth()->id(),
        ]);

        if ($request->parent_id) {
            return redirect()->route('folders.index', ['folder' => $request->parent_id]);
        }

        return redirect()->route('folders.index');
    }

    public function update(Request $request, Folder $folder)
    {
        $this->authorize('update', $folder);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $folder->update([
            'name' => $request->name,
        ]);

        return redirect()->route('folders.index', ['folder' => $folder->id]);
    }

    public function destroy(Folder $folder)
    {
        $this->authorize('delete', $folder);

        $parent_id = $folder->parent_id;

        $folder->delete();

        if ($parent_id) {
            return redirect()->route('folders.index', ['folder' => $parent_id]);
        }

        return redirect()->route('folders.index');
    }
}
