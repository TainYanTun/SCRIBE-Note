<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\GraphController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    $notes = $user->notes()->latest()->take(5)->get();
    $totalNotes = $user->notes()->count();
    $totalTags = $user->tags()->count();
    $allTags = $user->tags()->withCount(['notes' => function ($query) use ($user) {
        $query->where('user_id', $user->id);
    }])->get();
    return view('dashboard', compact('notes', 'totalNotes', 'totalTags', 'allTags'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/notes/search', [NoteController::class, 'search'])->name('notes.search');
    Route::resource('notes', NoteController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('tags', TagController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::get('/graph', [GraphController::class, 'index'])->name('graph.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
