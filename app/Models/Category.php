<?php

namespace App\Models;

use App\Models\Traits\HasChildren;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, HasChildren;

    protected $fillable = ['name', 'slug', 'parent_id', 'order'];

    public function scopeParents(Builder $builder)
    {
        $builder->whereNull('parent_id');
    }

    public function scopeOrdered(Builder $builder, $direction = 'asc')
    {
        $builder->orderBy('order', $direction);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
