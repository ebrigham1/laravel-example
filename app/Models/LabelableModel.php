<?php

namespace App\Models;

use App\Contracts\LabelableContract;
use App\Contracts\LabelableWithLocationContract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

abstract class LabelableModel extends Model implements LabelableContract
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
     * @return void
     */
    public function createLabels(int $number = 1, Location $location = null): void
    {
        $labels = [];
        $date = Carbon::now();
        for ($i = 0; $i < $number; $i++) {
            // Set up every key since we are using insert instead of createMany
            $label = [
                'labelable_id' => $this->id,
                'labelable_type' => $this->labels()->getMorphClass(),
                'created_at' => $date,
                'updated_at' => $date,
            ];
            // If this location was passed in and this labelable uses the LabelableWithLocationContract
            // additionally set the location_id key on this label
            if ($location instanceof Location && $this instanceof LabelableWithLocationContract) {
                $label['location_id'] = $location->id;
            }
            $labels[] = $label;
        }
        // Using insert here instead of createMany for speed reasons
        $this->labels()->insert($labels);
        if ($this instanceof LabelableWithLocationContract) {
            $this->increaseLocationQuantity($location->id, $number);
        }
    }

    /**
     * Get the name of this labelable model
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
