<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
