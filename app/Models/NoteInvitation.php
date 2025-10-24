<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NoteInvitation extends Model
{
    protected $fillable = [
        'note_id',
        'invited_user_id',
        'sharer_user_id',
        'permission',
        'token',
        'expires_at',
        'accepted_at',
    ];

    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class);
    }

    public function invitedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'invited_user_id');
    }

    public function sharerUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sharer_user_id');
    }
}
