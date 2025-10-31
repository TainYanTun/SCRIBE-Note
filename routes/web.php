<?php

use App\Http\Controllers\FolderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NoteShareController;
use App\Http\Controllers\NoteInvitationController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\NotificationController;
use App\Models\Note;
use App\Models\NoteLink;
use Illuminate\Support\Str;

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

    $notifications = $user->notifications()->whereNull('read_at')->latest()->take(5)->get();

    return view('dashboard', compact('notes', 'totalNotes', 'totalTags', 'allTags', 'totalNoteLinks', 'favoriteNotes', 'importantNotes', 'notifications'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/notes/search', [NoteController::class, 'search'])->name('notes.search');
    Route::resource('notes', NoteController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::post('/notes/{note}/toggle-tag', [NoteController::class, 'toggleTag'])->name('notes.toggleTag');
    Route::get('/notes/{note}/share', [NoteShareController::class, 'create'])->name('notes.share');
    Route::post('/notes/{note}/share', [NoteShareController::class, 'store'])->name('notes.processShare');
    Route::get('/notes/accept-invitation/{token}', [NoteInvitationController::class, 'accept'])->name('notes.acceptInvitation');
    Route::post('/notes/{note}/comments', [CommentController::class, 'store'])->name('notes.comments.store');
    Route::resource('tags', TagController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::get('/notes/{note}/export', [NoteController::class, 'export'])->name('notes.export');
    Route::get('/graph', [GraphController::class, 'index'])->name('graph.index');

    Route::get('/help', [App\Http\Controllers\HelpController::class, 'index'])->name('help.index');

    Route::get('/folders/{folder?}', [FolderController::class, 'index'])->name('folders.index');
    Route::resource('folders', FolderController::class)->only(['store', 'update', 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile/settings', [ProfileController::class, 'edit'])->name('profile.settings');
    Route::patch('/profile/settings', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/settings', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');

    // Notifications Route
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
});

require __DIR__.'/auth.php';
