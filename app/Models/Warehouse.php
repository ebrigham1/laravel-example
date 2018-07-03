<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Warehouse extends LabelableModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Sections one to many relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    /**
     * Locations has many through relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function locations(): HasManyThrough
    {
        return $this->hasManyThrough(Location::class, Section::class);
    }

    /**
     * Products many to many relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_warehouses')
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
     * Get the product labels associated with this warehouse
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productLabels(): HasMany
    {
        return $this->hasMany(Label::class)->where('labelable_type', 'product');
    }

    /**
     * Get the quantity of the given product at this warehouse
     *
     * @param int $productId
     * @return int
     */
    public function getProductQuantity(int $productId): int
    {
        if ($this->hasProduct($productId)) {
            return $this->products()->where('product_id', $productId)->first()->product_warehouse->quantity;
        } else {
            return 0;
        }
    }

    /**
     * Check if this warehouse has the given product
     *
     * @param int $productId
     * @return bool
     */
    public function hasProduct(int $productId): bool
    {
        return $this->productWarehouses()->where('product_id', $productId)->exists();
    }

    /**
     * Check if this warehouse has the given section
     *
     * @param int $sectionId
     * @return bool
     */
    public function hasSection(int $sectionId): bool
    {
        return $this->sections()->where('id', $sectionId)->exists();
    }

    /**
     * Check if this warehouse has the given location
     *
     * @param int $locationId
     * @return bool
     */
    public function hasLocation(int $locationId): bool
    {
        return $this->locations()->where('id', $locationId)->exists();
    }
}
