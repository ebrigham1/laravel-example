<?php

namespace App\Traits;

use App\Models\Label;
use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Labelable
{
    /**
     * Get all the labelable's labels
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function labels(): MorphMany
    {
        return $this->morphMany(Label::class, 'labelable');
    }

    /**
     * Create any number of labels for this labelable object
     *
     * @param int $number
     * @param \App\Models\Location|null $location
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function createLabels(int $number = 1, Location $location = null): Collection
    {
        $labels = [];
        while ($number > 0) {
            if ($location instanceof Location) {
                $labels[] = ['location_id' => $location->id];
            } else {
                $labels[] = [];
            }
            $number--;
        }
        return $this->labels()->createMany($labels);
    }
}
