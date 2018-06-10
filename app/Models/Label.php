<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Label extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['location_id'];

    /**
     * Get all of the owning labelable models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function labelable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the location this label belongs to if any.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
