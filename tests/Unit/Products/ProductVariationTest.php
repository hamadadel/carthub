<?php

namespace Tests\Unit\Products;

use App\Cart\Money;
use Tests\TestCase;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductVariationType;

class ProductVariationTest extends TestCase
{

    public function test_it_has_one_variation_type()
    {
        $productVariation = ProductVariation::factory()->create();
        $this->assertInstanceOf(ProductVariationType::class, $productVariation->type);
    }

    public function test_it_belongs_to_a_product()
    {
        $productVariation =  ProductVariation::factory()->create();
        $this->assertInstanceOf(Product::class, $productVariation->product);
    }

    public function test_it_returns_a_money_instance_for_the_price()
    {
        $productVariation = ProductVariation::factory()->create();
        $this->assertInstanceOf(Money::class, $productVariation->price);
    }

    public function test_it_returns_a_formatted_price()
    {
        $productVariation = ProductVariation::factory()->create([
            'price' => 10000
        ]);
        $this->assertEquals($productVariation->formattedPrice, '£100.00');
    }

    public function test_it_returns_a_the_product_price_if_price_is_null()
    {
        // $productVariation = ProductVariation::factory()->create();
        // $this->assertEquals($productVariation->price, $productVariation->product->price);
        $product = Product::factory()->create(['price' => 10000]);

        $productVariation = ProductVariation::factory()->create([
            'price' => null,
            'product_id' => $product->id
        ]);

        $this->assertEquals($product->price->amount(), $productVariation->price->amount());
    }

    public function test_it_can_check_if_the_product_variation_price_is_different_to_the_product()
    {
        $product = Product::factory()->create(['price' => 10000]);

        $productVariation = ProductVariation::factory()->create([
            'price' => 50000,
            'product_id' => $product->id
        ]);

        $this->assertTrue($productVariation->priceVaries());
    }
}
