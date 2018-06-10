<?php

namespace App\Observers;

use App\Contracts\LabelableWithLocationContract;
use App\Models\Label;
use App\Models\Location;

class LabelObserver
{
    /**
     * Listen to the label created event and increment the location quantity of the labelable
     * if applicable.
     *
     * @param  \App\Models\Label $label
     * @return void
     */
    public function created(Label $label): void
    {
        if ($label->labelable instanceof LabelableWithLocationContract) {
            $label->labelable->incrementLocationQuantity($label->location_id);
        }
    }

    /**
     * Listen to the label deleting event and decrement the location quantity of the labelable
     * if applicable.
     *
     * @param  \App\Models\Label $label
     * @return void
     */
    public function deleted(Label $label): void
    {
        if ($label->labelable instanceof LabelableWithLocationContract) {
            $label->labelable->decrementLocationQuantity($label->location_id);
        }
    }

    /**
     * Listen to the label updating event and decrement the old location quantity while incrementing
     * the new location quantity if applicable.
     *
     * @param  \App\Models\Label $label
     * @return void
     */
    public function updating(Label $label): void
    {
        if ($label->labelable instanceof LabelableWithLocationContract) {
            // If location id was updated decrement the original location and increment the new location
            if ($label->isDirty('location_id')) {
                $label->labelable->decrementLocationQuantity($label->getOriginal('location_id'));
                $label->labelable->incrementLocationQuantity($label->location_id);
            }
        }
    }
}
