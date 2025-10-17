<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'user_id',
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
}
