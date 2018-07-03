<?php

namespace App\Observers;

use App\Contracts\LabelableWithLocationContract;
use App\Models\Label;
use App\Models\Location;

class LabelObserver
{
    /**
     * Listen to the label created event and increment the location, section, and warehouse quantity of the labelable
     * if applicable.
     *
     * @param  \App\Models\Label $label
     * @return void
     */
    public function created(Label $label): void
    {
        if ($label->labelable instanceof LabelableWithLocationContract) {
            $label->labelable->incrementLocationQuantity($label->location_id);
            if ($label->location->section_id !== null) {
                $label->labelable->incrementSectionQuantity($label->location->section_id);
                $label->labelable->incrementWarehouseQuantity($label->location->section->warehouse_id);
            }
        }
    }

    /**
     * Listen to the label deleting event and decrement the location, section, and warehouse quantity of the labelable
     * if applicable.
     *
     * @param  \App\Models\Label $label
     * @return void
     */
    public function deleted(Label $label): void
    {
        if ($label->labelable instanceof LabelableWithLocationContract) {
            $label->labelable->decrementLocationQuantity($label->location_id);
            if ($label->location->section_id !== null) {
                $label->labelable->decrementSectionQuantity($label->location->section_id);
                $label->labelable->decrementWarehouseQuantity($label->location->section->warehouse_id);
            }
        }
    }

    /**
     * Listen to the label updating event and decrement the old location, section, and warehouse quantity
     * while incrementing the new location, section, and warehouse quantity if applicable.
     *
     * @param  \App\Models\Label $label
     * @return void
     */
    public function updating(Label $label): void
    {
        if ($label->labelable instanceof LabelableWithLocationContract) {
            // If location id was updated decrement the original location and increment the new location
            if ($label->isDirty('location_id')) {
                $oldLocation = Location::with('section')->find($label->getOriginal('location_id'));
                $label->labelable->decrementLocationQuantity($label->getOriginal('location_id'));
                if ($oldLocation->section_id !== null) {
                    $label->labelable->decrementSectionQuantity($oldLocation->section_id);
                    $label->labelable->decrementWarehouseQuantity($oldLocation->section->warehouse_id);
                }
                $label->labelable->incrementLocationQuantity($label->location_id);
                if ($label->location->section_id !== null) {
                    $label->labelable->incrementSectionQuantity($label->location->section_id);
                    $label->labelable->incrementWarehouseQuantity($label->location->section->warehouse_id);
                }
            }
        }
    }
}
