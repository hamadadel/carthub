<?php

namespace App\Models\Traits;

use App\Models\Category;

trait HasChildren
{
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
