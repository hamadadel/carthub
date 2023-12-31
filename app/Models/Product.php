<?php

namespace App\Models;

use App\Scoping\Scoper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        /**
         * that means that when we look these up inside our routes
         * we're going to use the slug.
         */
        return 'slug';
    }


    public function scopeWithScopes(Builder $builder, $scopes = [])
    {
        return (new Scoper(request()))->apply($builder, $scopes);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
