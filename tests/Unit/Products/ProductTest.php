<?php

namespace Tests\Unit\Products;

use App\Models\{Product, Category, ProductVariation};
use App\Cart\Money;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_it_uses_the_slug_for_the_route_key_name(): void
    {
        $product = new Product();
        $this->assertEquals($product->getRouteKeyName(), 'slug');
    }

    public function test_it_hasMany_categories()
    {
        $product = Product::factory()->create();
        $product->categories()->save(
            Category::factory()->create()
        );
        $this->assertInstanceOf(Category::class, $product->categories()->first());
    }

    public function test_it_hasMany_variations()
    {
        $product = Product::factory()->create();
        $product->variations()->save(
            ProductVariation::factory()->create()
        );
        $this->assertInstanceOf(ProductVariation::class, $product->variations()->first());
    }

    public function test_it_returns_a_money_instance_for_the_price()
    {
        $product = Product::factory()->create();
        $this->assertInstanceOf(Money::class, $product->price);
    }

    public function test_it_returns_a_formatted_price()
    {
        $product = Product::factory()->create(
            ['price' => 1000]
        );
        $this->assertEquals($product->formattedPrice, '£10.00');
    }
}
