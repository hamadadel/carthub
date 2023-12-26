<?php

namespace Tests\Unit\Models\Categories;

use App\Models\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_it_hasMany_children()
    {
        $category = Category::factory()->create();
        dd($category);
        $category->children()->save(
            Category::factory()->create()
        );

        $this->assertNotInstanceOf(Category::class, $category->children()->first());
    }
}
