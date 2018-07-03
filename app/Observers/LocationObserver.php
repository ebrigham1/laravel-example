<?php

namespace App\Observers;

use App\Models\Location;
use App\Models\Section;

class LocationObserver
{
    /**
     * Listen to the location deleting event and decrement the section and warehouse quantity of any
     * labelable with locations contained within.
     *
     * @param  \App\Models\Location $location
     * @return void
     */
    public function deleted(Location $location): void
    {
        // We only need to worry about decrementing if there was previously a section attached to this location
        if ($location->section instanceof Section) {
            $products = $location->products;
            if ($products->isNotEmpty()) {
                // Loop through every product in this location and make sure its section and warehouse quantity
                // is updated
                foreach ($products as $product) {
                    $product->decreaseSectionQuantity($location->section_id, $product->pivot->quantity);
                    $product->decreaseWarehouseQuantity($location->section->warehouse_id, $product->pivot->quantity);
                }
            }
        }
    }

    /**
     * Listen to the location updating event and decrement the old section and warehouse quantity while incrementing the
     * new section and warehouse quantity of any labelable with locations contained within.
     *
     * @param  \App\Models\Location $location
     * @return void
     */
    public function updating(Location $location): void
    {
        // If section id was updated check if we need to increment or decrement the old and new section and warehouse
        if ($location->isDirty('section_id')) {
            $products = $location->products;
            if ($products->isNotEmpty()) {
                // If the location previously had a section id we need to decrease quantity for the old
                // section and warehouse
                if ($location->getOriginal('section_id') !== null) {
                    $oldSection = Section::find($location->getOriginal('section_id'));
                    // Loop through every product in this location and make sure its section and warehouse quantity
                    // is updated
                    foreach ($products as $product) {
                        $product->decreaseSectionQuantity($oldSection->id, $product->pivot->quantity);
                        $product->decreaseWarehouseQuantity($oldSection->warehouse_id, $product->pivot->quantity);
                    }
                }
                // If we have a new section we need to increase quantity for the new section and warehouse
                if ($location->section_id !== null) {
                    foreach ($products as $product) {
                        $product->increaseSectionQuantity($location->section_id, $product->pivot->quantity);
                        $product->increaseWarehouseQuantity(
                            $location->section->warehouse_id,
                            $product->pivot->quantity
                        );
                    }
                }
            }
        }
    }
}
