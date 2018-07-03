<?php

namespace App\Models;

use App\Contracts\LabelableWithLocationContract;

abstract class LabelableWithLocationModel extends LabelableModel implements LabelableWithLocationContract
{
    /**
     * Increment the quantity of this labelable with location model at a given location
     *
     * @param int $locationId
     * @return void
     */
    public function incrementLocationQuantity(int $locationId): void
    {
        $this->increaseLocationQuantity($locationId, 1);
    }

    /**
     * Increment the quantity of this labelable with location model at a given section
     *
     * @param int $sectionId
     * @return void
     */
    public function incrementSectionQuantity(int $sectionId): void
    {
        $this->increaseSectionQuantity($sectionId, 1);
    }

    /**
     * Increment the quantity of this labelable with location model at a given warehouse
     *
     * @param int $warehouseId
     * @return void
     */
    public function incrementWarehouseQuantity(int $warehouseId): void
    {
        $this->increaseWarehouseQuantity($warehouseId, 1);
    }

    /**
     * Decrement the quantity of this labelable with location model at a given location
     *
     * @param int $locationId
     * @return void
     */
    public function decrementLocationQuantity(int $locationId): void
    {
        $this->decreaseLocationQuantity($locationId, 1);
    }

    /**
     * Decrement the quantity of this labelable with location model at a given section
     *
     * @param int $sectionId
     * @return void
     */
    public function decrementSectionQuantity(int $sectionId): void
    {
        $this->decreaseSectionQuantity($sectionId, 1);
    }

    /**
     * Decrement the quantity of this labelable with location model at a given warehouse
     *
     * @param int $warehouseId
     * @return void
     */
    public function decrementWarehouseQuantity(int $warehouseId): void
    {
        $this->decreaseWarehouseQuantity($warehouseId, 1);
    }
}
