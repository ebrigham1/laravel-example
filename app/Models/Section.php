<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends LabelableModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'warehouse_id'];

    /**
     * Warehouse belongs to relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Locations one to many relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }

    /**
     * Products many to many relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_sections')
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
     * Get the product labels associated with this section
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productLabels(): HasMany
    {
        return $this->hasMany(Label::class)->where('labelable_type', 'product');
    }

    /**
     * Get the quantity of the given product at this section
     *
     * @param int $productId
     * @return int
     */
    public function getProductQuantity(int $productId): int
    {
        if ($this->hasProduct($productId)) {
            return $this->products()->where('product_id', $productId)->first()->product_section->quantity;
        } else {
            return 0;
        }
    }

    /**
     * Check if this section has the given product
     *
     * @param int $productId
     * @return bool
     */
    public function hasProduct(int $productId): bool
    {
        return $this->productSections()->where('product_id', $productId)->exists();
    }

    /**
     * Check if this section has the given location
     *
     * @param int $locationId
     * @return bool
     */
    public function hasLocation(int $locationId): bool
    {
        return $this->locations()->where('id', $locationId)->exists();
    }
}
