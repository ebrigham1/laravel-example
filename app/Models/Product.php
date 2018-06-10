<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends LabelableWithLocationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Locations many to many relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(Location::class, 'product_locations')
            ->withPivot('quantity')->withTimestamps();
    }

    /**
     * Product locations one to many relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productLocations(): HasMany
    {
        return $this->hasMany(ProductLocation::class);
    }

    /**
     * Get the quantity of this product at a given location
     *
     * @param int $locationId
     * @return int
     */
    public function getLocationQuantity($locationId): int
    {
        if ($this->isInLocation($locationId)) {
            return $this->productLocations()->where('location_id', $locationId)->first()->quantity;
        } else {
            return 0;
        }
    }

    /**
     * Check if this product is in the given location
     *
     * @param int $locationId
     * @return bool
     */
    public function isInLocation(int $locationId): bool
    {
        return $this->productLocations()->where('location_id', $locationId)->exists();
    }

    /**
     * Increment the quantity of this product at a given location
     *
     * @param int $locationId
     * @return void
     */
    public function incrementLocationQuantity(int $locationId): void
    {
        $this->increaseLocationQuantity($locationId, 1);
    }

    /**
     * Decrement the quantity of this product at a given location
     *
     * @param int $locationId
     * @return void
     */
    public function decrementLocationQuantity(int $locationId): void
    {
        $this->decreaseLocationQuantity($locationId, 1);
    }

    /**
     * Increase the quantity of this product at a given location by the given amount
     *
     * @param int $locationId
     * @param int $number
     * @return void
     */
    public function increaseLocationQuantity(int $locationId, int $number = 1): void
    {
        if ($this->isInLocation($locationId)) {
            $productLocation = $this->productLocations()->where('location_id', $locationId)->first();
            $productLocation->quantity += $number;
            $productLocation->save();
        } else {
            $this->locations()->attach($locationId, ['quantity' => $number]);
        }
    }

    /**
     * Decrease the quantity of this product at a given location by the given amount
     *
     * @param int $locationId
     * @param int $number
     * @return void
     */
    public function decreaseLocationQuantity(int $locationId, int $number = 1): void
    {
        if ($this->isInLocation($locationId)) {
            $productLocation = $this->productLocations()->where('location_id', $locationId)->first();
            if ($productLocation->quantity <= 1) {
                $this->locations()->detach($locationId);
            } else {
                $productLocation->quantity -= $number;
                $productLocation->save();
            }
        }
    }
}
