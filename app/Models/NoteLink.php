<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class NoteLink extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'note_links';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}