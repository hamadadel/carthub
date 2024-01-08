<?php

namespace App\Models;

use App\Cart\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasPrice;

class ProductVariation extends Model
{
    use HasFactory, HasPrice;

    public function getPriceAttribute($value)
    {
        if (null === $value)
            return $this->product->price;
        return new Money($value);
    }

    // handle price doesn't match parent's price
    public function priceVaries()
    {
        return $this->price->amount() !== $this->product->price->amount();
    }

    public function stockCount()
    {
        return $this->stock->sum('pivot.stock');
    }

    public function inStock()
    {
        return $this->stockCount() > 0;
    }

    // RELATIONSHIPS

    public function type()
    {
        return $this->hasOne(ProductVariationType::class, 'id', 'product_variation_type_id');
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function stocks()
    {
        // each stock block
        return $this->hasMany(Stock::class);
    }

    public function stock()
    {
        // A single stock representation for each product whether it's in stock and how many are in stock
        return $this->belongsToMany(
            ProductVariation::class,
            'product_variation_stock_view'
        )->withPivot(
            ['stock', 'in_stock']
        );
    }
}
