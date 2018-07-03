<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends LabelableModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'section_id'];

    /**
     * Section belongs to relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * Products many to many relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_locations')
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
     * Get the product labels associated with this location
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productLabels(): HasMany
    {
        return $this->hasMany(Label::class)->where('labelable_type', 'product');
    }

    /**
     * Get the quantity of the given product at this location
     *
     * @param int $productId
     * @return int
     */
    public function getProductQuantity($productId): int
    {
        if ($this->hasProduct($productId)) {
            return $this->products()->where('product_id', $productId)->first()->product_location->quantity;
        } else {
            return 0;
        }
    }

    /**
     * Check if this location has the given product
     *
     * @param int $productId
     * @return bool
     */
    public function hasProduct($productId): bool
    {
        return $this->productLocations()->where('product_id', $productId)->exists();
    }
}
