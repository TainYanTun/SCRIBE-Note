<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Taggable extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'taggables';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}