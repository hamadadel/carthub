<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'parent_id', 'order'];

    // [Scope] allow us to only grab the parents of this category
    public function scopeParents(Builder $builder)
    {
        $builder->whereNull('parent_id');
    }

    public function scopeOrdered(Builder $builder, $direction = 'desc')
    {
        $builder->orderBy('order', $direction);
    }

    // get all Category Children

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
