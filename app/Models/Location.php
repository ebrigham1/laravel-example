<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends LabelableModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

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
     * Get the labelableLabelsproduct labels associated with this location
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
     * @param \App\Models\Product $product
     * @return int
     */
    public function getProductQuantity(Product $product): int
    {
        if ($this->hasProduct($product)) {
            return $this->products()->where('product_id', $product->id)->first()->product_location->quantity;
        } else {
            return 0;
        }
    }

    /**
     * Check if this location has the given product
     *
     * @param \App\Models\Product $product
     * @return bool
     */
    public function hasProduct(Product $product): bool
    {
        return $this->productLocations()->where('product_id', $product->id)->exists();
    }

    /**
     * Increment the quantity of the given product at this location
     *
     * @param \App\Models\Product $product
     * @return void
     */
    public function incrementProductQuantity(Product $product): void
    {
        $this->increaseProductQuantity($product, 1);
    }

    /**
     * Decrement the quantity of the given product at this location
     *
     * @param \App\Models\Product $product
     * @return void
     */
    public function decrementProductQuantity(Product $product): void
    {
        $this->decreaseProductQuantity($product, 1);
    }

    /**
     * Increase the quantity of the given product at this location
     *
     * @param \App\Models\Product $product
     * @param int $number
     * @return void
     */
    public function increaseProductQuantity(Product $product, int $number = 1): void
    {
        if ($this->hasProduct($product)) {
            $productLocation = $this->productLocations()->where('product_id', $product->id)->first();
            $productLocation->quantity += $number;
            $productLocation->save();
        } else {
            $this->products()->attach($product->id, ['quantity' => $number]);
        }
    }

    /**
     * Decrease the quantity of the given product at this location
     *
     * @param \App\Models\Product $product
     * @param int $number
     * @return void
     */
    public function decreaseProductQuantity(Product $product, int $number = 1): void
    {
        if ($this->hasProduct($product)) {
            $productLocation = $this->productLocations()->where('product_id', $product->id)->first();
            if ($productLocation->quantity <= 1) {
                $this->products()->detach($product->id);
            } else {
                $productLocation->quantity -= $number;
                $productLocation->save();
            }
        }
    }
}
