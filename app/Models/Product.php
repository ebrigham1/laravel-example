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
     * Sections many to many relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(Section::class, 'product_sections')
            ->withPivot('quantity')->withTimestamps();
    }

    /**
     * Product sections one to many relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productSections(): HasMany
    {
        return $this->hasMany(ProductSection::class);
    }

    /**
     * Warehouses many to many relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function warehouses(): BelongsToMany
    {
        return $this->belongsToMany(Warehouse::class, 'product_warehouses')
            ->withPivot('quantity')->withTimestamps();
    }

    /**
     * Product warehouses one to many relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productWarehouses(): HasMany
    {
        return $this->hasMany(ProductWarehouse::class);
    }

    /**
     * Get the quantity of this product at a given location
     *
     * @param int $locationId
     * @return int
     */
    public function getLocationQuantity(int $locationId): int
    {
        if ($this->isInLocation($locationId)) {
            return $this->productLocations()->where('location_id', $locationId)->first()->quantity;
        } else {
            return 0;
        }
    }

    /**
     * Get the quantity of this product at a given section
     *
     * @param int $sectionId
     * @return int
     */
    public function getSectionQuantity(int $sectionId): int
    {
        if ($this->isInSection($sectionId)) {
            return $this->productSections()->where('section_id', $sectionId)->first()->quantity;
        } else {
            return 0;
        }
    }

    /**
     * Get the quantity of this product at a given warehouse
     *
     * @param int $warehouseId
     * @return int
     */
    public function getWarehouseQuantity(int $warehouseId): int
    {
        if ($this->isInWarehouse($warehouseId)) {
            return $this->productWarehouses()->where('warehouse_id', $warehouseId)->first()->quantity;
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
     * Check if this product is in the given section
     *
     * @param int $sectionId
     * @return bool
     */
    public function isInSection(int $sectionId): bool
    {
        return $this->productSections()->where('section_id', $sectionId)->exists();
    }

    /**
     * Check if this product is in the given warehouse
     *
     * @param int $sectionId
     * @return bool
     */
    public function isInWarehouse(int $warehouseId): bool
    {
        return $this->productWarehouses()->where('warehouse_id', $warehouseId)->exists();
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
     * Increase the quantity of this product at a given section by the given amount
     *
     * @param int $sectionId
     * @param int $number
     * @return void
     */
    public function increaseSectionQuantity(int $sectionId, int $number = 1): void
    {
        if ($this->isInSection($sectionId)) {
            $productSection = $this->productSections()->where('section_id', $sectionId)->first();
            $productSection->quantity += $number;
            $productSection->save();
        } else {
            $this->sections()->attach($sectionId, ['quantity' => $number]);
        }
    }

    /**
     * Increase the quantity of this product at a given warehouse by the given amount
     *
     * @param int $warehouseId
     * @param int $number
     * @return void
     */
    public function increaseWarehouseQuantity(int $warehouseId, int $number = 1): void
    {
        if ($this->isInWarehouse($warehouseId)) {
            $productWarehouse = $this->productWarehouses()->where('warehouse_id', $warehouseId)->first();
            $productWarehouse->quantity += $number;
            $productWarehouse->save();
        } else {
            $this->warehouses()->attach($warehouseId, ['quantity' => $number]);
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
            if ($productLocation->quantity - $number <= 1) {
                $this->locations()->detach($locationId);
            } else {
                $productLocation->quantity -= $number;
                $productLocation->save();
            }
        }
    }

    /**
     * Decrease the quantity of this product at a given section by the given amount
     *
     * @param int $sectionId
     * @param int $number
     * @return void
     */
    public function decreaseSectionQuantity(int $sectionId, int $number = 1): void
    {
        if ($this->isInSection($sectionId)) {
            $productSection = $this->productSections()->where('section_id', $sectionId)->first();
            if ($productSection->quantity - $number <= 1) {
                $this->sections()->detach($sectionId);
            } else {
                $productSection->quantity -= $number;
                $productSection->save();
            }
        }
    }

    /**
     * Decrease the quantity of this product at a given warehouse by the given amount
     *
     * @param int $warehouseId
     * @param int $number
     * @return void
     */
    public function decreaseWarehouseQuantity(int $warehouseId, int $number = 1): void
    {
        if ($this->isInWarehouse($warehouseId)) {
            $productWarehouse = $this->productWarehouses()->where('warehouse_id', $warehouseId)->first();
            if ($productWarehouse->quantity - $number <= 1) {
                $this->warehouses()->detach($warehouseId);
            } else {
                $productWarehouse->quantity -= $number;
                $productWarehouse->save();
            }
        }
    }
}
