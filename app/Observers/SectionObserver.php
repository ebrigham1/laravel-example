<?php

namespace App\Observers;

use App\Models\Section;

class SectionObserver
{
    /**
     * Listen to the section deleting event and decrement the warehouse quantity of any labelable with locations
     * contained within.
     *
     * @param  \App\Models\Section $section
     * @return void
     */
    public function deleted(Section $section): void
    {
        $products = $section->products;
        if ($products->isNotEmpty()) {
            // Loop through every product in this section and make sure its warehouse quantity is updated
            foreach ($products as $product) {
                $product->decreaseWarehouseQuantity($section->warehouse_id, $product->pivot->quantity);
            }
        }
    }

    /**
     * Listen to the section updating event and decrement the old warehouse quantity while incrementing the
     * new warehouse quantity of any labelable with locations contained within.
     *
     * @param  \App\Models\Section $section
     * @return void
     */
    public function updating(Section $section): void
    {
        // If warehouse id was updated decrement the old warehouse and increment the new warehouse
        if ($section->isDirty('warehouse_id')) {
            $products = $section->products;
            if ($products->isNotEmpty()) {
                // Loop through every product in this location and make sure its warehouse quantities are updated
                foreach ($products as $product) {
                    $product->decreaseWarehouseQuantity(
                        $section->getOriginal('warehouse_id'),
                        $product->pivot->quantity
                    );
                    $product->increaseWarehouseQuantity($section->warehouse_id, $product->pivot->quantity);
                }
            }
        }
    }
}
