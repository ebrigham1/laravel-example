<?php

namespace Tests\Feature;

use App\Models\Location;
use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test is in location returns true when a product is in a location
     *
     * @return void
     */
    public function testIsInLocationTrue()
    {
        // Setup two test products and two test locations
        $products = factory(Product::class, 2)->create();
        $locations = factory(Location::class, 2)->create();

        // Create one label for $products[0] in $locations[0] and make sure isInLocation reports true for
        // $products[0] in $locations[0]
        $products[0]->createLabels(1, $locations[0]);
        $this->assertTrue($products[0]->isInLocation($locations[0]->id));

        // Create two more labels for $products[0] in $locations[0] and make sure isInLocation still reports true
        // for $products[0] in $locations[0], this makes sure the number of labels has no effect on isInLocation
        $products[0]->createLabels(2, $locations[0]);
        $this->assertTrue($products[0]->isInLocation($locations[0]->id));

        // Create one label for $products[1] in $locations[1] and make sure it doesn't effect isInLocation for
        // $products[0] in $locations[0] also make sure $products[1] is now reported in $locations[1]
        $products[1]->createLabels(1, $locations[1]);
        $this->assertTrue($products[0]->isInLocation($locations[0]->id));
        $this->assertTrue($products[1]->isInLocation($locations[1]->id));

        // Create two more labels for $products[1] in $locations[1] and make sure it doesn't effect isInLocation for
        // $products[0] in $locations[0] or isInLocation for $products[1] in $locations[1]
        $products[1]->createLabels(2, $locations[1]);
        $this->assertTrue($products[0]->isInLocation($locations[0]->id));
        $this->assertTrue($products[1]->isInLocation($locations[1]->id));
    }

    /**
     * Test is in location returns false when a product is not in a location
     *
     * @return void
     */
    public function testIsInLocationFalse()
    {
        // Setup two test products and two test locations
        $products = factory(Product::class, 2)->create();
        $locations = factory(Location::class, 2)->create();

        // Make sure when no labels are created for either product that neither is considered in either location
        $this->assertFalse($products[0]->isInLocation($locations[0]->id));
        $this->assertFalse($products[0]->isInLocation($locations[1]->id));
        $this->assertFalse($products[1]->isInLocation($locations[0]->id));
        $this->assertFalse($products[1]->isInLocation($locations[1]->id));

        // Create one label for $products[0] in $locations[0] and make sure isInLocation reports false for
        // $products[0] in $locations[1] (its only in $locations[0]
        $products[0]->createLabels(1, $locations[0]);
        $this->assertFalse($products[0]->isInLocation($locations[1]->id));

        // Create two more labels for $products[0] in $locations[0] and make sure isInLocation still reports false
        // for $products[0] in $locations[1], this makes sure the number of labels has no effect on isInLocation
        $products[0]->createLabels(2, $locations[0]);
        $this->assertFalse($products[0]->isInLocation($locations[1]->id));

        // Create one label for $products[1] in $locations[1] and make sure it doesn't effect isInLocation for
        // $products[0] in $locations[1] also make sure $products[1] is not reported in $locations[0]
        $products[1]->createLabels(1, $locations[1]);
        $this->assertFalse($products[0]->isInLocation($locations[1]->id));
        $this->assertFalse($products[1]->isInLocation($locations[0]->id));

        // Create two more labels for $products[1] in $locations[0] and make sure isInLocation still reports true
        // for $products[0] in $locations[0], this makes sure the number of labels has no effect on isInLocation
        $products[1]->createLabels(2, $locations[1]);
        $this->assertFalse($products[0]->isInLocation($locations[1]->id));
        $this->assertFalse($products[1]->isInLocation($locations[0]->id));
    }

    /**
     * Test that locations quantities are kept track of when increasing and decreasing in a variety of circumstances
     *
     * @return void
     */
    public function testLocationQuantity()
    {
        // Setup two test products and two test locations
        $products = factory(Product::class, 2)->create();
        $locations = factory(Location::class, 2)->create();

        // Create one label for $products[0] in $locations[0] and our product_locations records are correct
        // and have the correct quantity
        $products[0]->createLabels(1, $locations[0]);

        // We've created one label and put it in a given location so the location quantity for that should be stored
        // in the database at this point
        $this->assertDatabaseHas('product_locations', [
            'product_id' => $products[0]->id,
            'location_id' => $locations[0]->id,
            'quantity' => 1,
        ]);
        // There should be no record here at this point since there is no quantity in this location
        $this->assertDatabaseMissing('product_locations', [
            'product_id' => $products[0]->id,
            'location_id' => $locations[1]->id,
        ]);
        // There should be no record here at this point since we didn't create labels for this product
        $this->assertDatabaseMissing('product_locations', [
            'product_id' => $products[1]->id,
            'location_id' => $locations[0]->id,
        ]);

        // Create two more labels in the location and make sure the location quantity is updated correctly
        $products[0]->createLabels(2, $locations[0]);
        $this->assertDatabaseHas('product_locations', [
            'product_id' => $products[0]->id,
            'location_id' => $locations[0]->id,
            'quantity' => 3,
        ]);

        // Remove one of the labels and make sure the the quantity is updated correctly
        $label = $products[0]->labels()->first();
        $label->delete();
        $this->assertDatabaseHas('product_locations', [
            'product_id' => $products[0]->id,
            'location_id' => $locations[0]->id,
            'quantity' => 2,
        ]);
        // Move a label and make sure the quantity is updated correctly
        $label = $products[0]->labels()->first();
        $label->location_id = $locations[1]->id;
        $label->save();
        $this->assertDatabaseHas('product_locations', [
            'product_id' => $products[0]->id,
            'location_id' => $locations[0]->id,
            'quantity' => 1,
        ]);
        $this->assertDatabaseHas('product_locations', [
            'product_id' => $products[0]->id,
            'location_id' => $locations[1]->id,
            'quantity' => 1,
        ]);

        // Now delete the remaining labels and make sure we are back to no quantities anywhere
        $label->delete();
        $label = $products[0]->labels()->first();
        $label->delete();
        $this->assertDatabaseMissing('product_locations', [
            'product_id' => $products[0]->id,
            'location_id' => $locations[0]->id,
        ]);
        $this->assertDatabaseMissing('product_locations', [
            'product_id' => $products[0]->id,
            'location_id' => $locations[1]->id,
        ]);
    }
}
