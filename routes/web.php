<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\GraphController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    $notes = $user->notes()->latest()->take(5)->get();
    $totalNotes = $user->notes()->count();
    $totalTags = $user->tags()->count();
    $allTags = $user->tags()->withCount(['notes' => function ($query) use ($user) {
        $query->where('user_id', $user->id);
    }])->orderBy('notes_count', 'desc')->get();

    $userNotesIds = $user->notes()->pluck('id');
    $totalNoteLinks = \App\Models\NoteLink::whereIn('source_note_id', $userNotesIds)
                                        ->orWhereIn('target_note_id', $userNotesIds)
                                        ->count();

    $favoriteNotes = App\Models\Note::where('user_id', auth()->id())
        ->whereHas('tags', function ($query) {
            $query->where('name', 'favorite');
        })->latest()->get();

    $importantNotes = App\Models\Note::where('user_id', auth()->id())
        ->whereHas('tags', function ($query) {
            $query->where('name', 'important');
        })->latest()->get();

    return view('dashboard', compact('notes', 'totalNotes', 'totalTags', 'allTags', 'totalNoteLinks', 'favoriteNotes', 'importantNotes'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/notes/search', [NoteController::class, 'search'])->name('notes.search');
    Route::resource('notes', NoteController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::post('/notes/{note}/toggle-tag', [NoteController::class, 'toggleTag'])->name('notes.toggleTag');
    Route::resource('tags', TagController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::get('/graph', [GraphController::class, 'index'])->name('graph.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
