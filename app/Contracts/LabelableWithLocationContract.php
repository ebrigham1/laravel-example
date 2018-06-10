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
    public function getLocationQuantity($locationId): int;

    /**
     * Check if this labelable is in the given location
     *
     * @param int $locationId
     * @return bool
     */
    public function isInLocation(int $locationId): bool;

    /**
     * Get the quantity of this product at a given location
     *
     * @param int $locationId
     * @return void
     */
    public function incrementLocationQuantity(int $locationId): void;

    /**
     * Get the quantity of this product at a given location
     *
     * @param int $locationId
     * @return void
     */
    public function decrementLocationQuantity(int $locationId): void;

    /**
     * Increase the quantity of this product at a given location by the given amount
     *
     * @param int $locationId
     * @param int $number
     * @return void
     */
    public function increaseLocationQuantity(int $locationId, int $number = 1): void;

    /**
     * Decrease the quantity of this product at a given location by the given amount
     *
     * @param int $locationId
     * @param int $number
     * @return void
     */
    public function decreaseLocationQuantity(int $locationId, int $number = 1): void;
}
