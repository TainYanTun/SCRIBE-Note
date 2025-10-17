<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Get all of the notes that are assigned this tag.
     */
    public function notes(): MorphToMany
    {
        return $this->morphedByMany(Note::class, 'taggable');
    }
}