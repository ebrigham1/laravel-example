<?php

namespace App\Contracts;

interface LabelableWithLocationContract extends LabelableContract
{
    /**
     * Get the quantity of this labelable at a given location
     *
     * @param int $locationId
     * @return int
     */
    public function getLocationQuantity(int $locationId): int;

    /**
     * Get the quantity of this product at a given section
     *
     * @param int $sectionId
     * @return int
     */
    public function getSectionQuantity(int $sectionId): int;

    /**
     * Get the quantity of this product at a given warehouse
     *
     * @param int $warehouseId
     * @return int
     */
    public function getWarehouseQuantity(int $warehouseId): int;

    /**
     * Check if this labelable is in the given location
     *
     * @param int $locationId
     * @return bool
     */
    public function isInLocation(int $locationId): bool;

    /**
     * Check if this product is in the given section
     *
     * @param int $sectionId
     * @return bool
     */
    public function isInSection(int $sectionId): bool;

    /**
     * Check if this product is in the given warehouse
     *
     * @param int $sectionId
     * @return bool
     */
    public function isInWarehouse(int $warehouseId): bool;

    /**
     * Get the quantity of this product at a given location
     *
     * @param int $locationId
     * @return void
     */
    public function incrementLocationQuantity(int $locationId): void;

    /**
     * Increment the quantity of this labelable with location model at a given section
     *
     * @param int $sectionId
     * @return void
     */
    public function incrementSectionQuantity(int $sectionId): void;

    /**
     * Increment the quantity of this labelable with location model at a given warehouse
     *
     * @param int $warehouseId
     * @return void
     */
    public function incrementWarehouseQuantity(int $warehouseId): void;

    /**
     * Get the quantity of this product at a given location
     *
     * @param int $locationId
     * @return void
     */
    public function decrementLocationQuantity(int $locationId): void;

    /**
     * Decrement the quantity of this labelable with location model at a given section
     *
     * @param int $sectionId
     * @return void
     */
    public function decrementSectionQuantity(int $sectionId): void;

    /**
     * Decrement the quantity of this labelable with location model at a given warehouse
     *
     * @param int $warehouseId
     * @return void
     */
    public function decrementWarehouseQuantity(int $warehouseId): void;

    /**
     * Increase the quantity of this product at a given location by the given amount
     *
     * @param int $locationId
     * @param int $number
     * @return void
     */
    public function increaseLocationQuantity(int $locationId, int $number = 1): void;

    /**
     * Increase the quantity of this product at a given section by the given amount
     *
     * @param int $sectionId
     * @param int $number
     * @return void
     */
    public function increaseSectionQuantity(int $sectionId, int $number = 1): void;

    /**
     * Increase the quantity of this product at a given warehouse by the given amount
     *
     * @param int $warehouseId
     * @param int $number
     * @return void
     */
    public function increaseWarehouseQuantity(int $warehouseId, int $number = 1): void;

    /**
     * Decrease the quantity of this product at a given location by the given amount
     *
     * @param int $locationId
     * @param int $number
     * @return void
     */
    public function decreaseLocationQuantity(int $locationId, int $number = 1): void;

    /**
     * Decrease the quantity of this product at a given section by the given amount
     *
     * @param int $sectionId
     * @param int $number
     * @return void
     */
    public function decreaseSectionQuantity(int $sectionId, int $number = 1): void;

    /**
     * Decrease the quantity of this product at a given warehouse by the given amount
     *
     * @param int $warehouseId
     * @param int $number
     * @return void
     */
    public function decreaseWarehouseQuantity(int $warehouseId, int $number = 1): void;
}
