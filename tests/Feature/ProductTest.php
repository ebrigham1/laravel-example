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
}
