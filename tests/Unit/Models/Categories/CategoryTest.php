<?php

namespace Tests\Unit\Models\Categories;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_it_hasMany_children()
    {
        $category = Category::factory()->create();
        $category->children()->save(
            Category::factory()->create()
        );
        // $this->assertInstanceOf(Collection::class, $category->children);
        $this->assertInstanceOf(Category::class, $category->children()->first());
    }

    public function test_it_can_fetch_only_parents()
    {
        $category = Category::factory()->create();
        $category->children()->save(
            Category::factory()->create()
        );

        $this->assertEquals(1, Category::parents()->count());
    }

    public function test_it_is_orderable_by_a_numbered_order()
    {
        $category = Category::factory()->create(
            ['order' => 2]
        );

        $category2 = Category::factory()->create(['order' => 1]);

        $this->assertEquals($category2->name, Category::ordered()->first()->name);
    }

    public function test_it_has_many_products()
    {
        $category = Category::factory()->create();
        $category->products()->save(Product::factory()->create());

        $this->assertInstanceOf(Product::class, $category->products()->first());
    }
}
