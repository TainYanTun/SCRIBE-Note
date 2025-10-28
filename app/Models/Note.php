<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'user_id',
        'folder_id',
        'version',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the tags for the note.
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * The notes that this note links to.
     */
    public function linkedNotes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class, 'note_links', 'source_note_id', 'target_note_id');
    }

    /**
     * The notes that link to this note.
     */
    public function linkedByNotes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class, 'note_links', 'target_note_id', 'source_note_id');
    }

    /**
     * The users that this note is shared with.
     */
    public function sharedWithUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'note_user')->withPivot('permission');
    }

    /**
     * Get all of the comments for the note.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }
}
