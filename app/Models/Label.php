<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Label extends Model
{
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name', 'show_url'];

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

    /**
     * Get the url to show this label
     *
     * @return string
     */
    public function getShowUrlAttribute(): string
    {
        return route('labels.show', ['label' => $this]);
    }

    /**
     * Get the name for this label
     *
     * @return string
     */
    public function getNameAttribute(): string
    {
        return $this->labelable->getName();
    }
}
