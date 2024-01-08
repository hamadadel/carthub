<?php

namespace Tests\Unit\Models\Products;

use App\Cart\Money;
use Tests\TestCase;
use App\Models\Stock;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductVariationType;
use Database\Factories\StockFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductVariationTest extends TestCase
{
    use RefreshDatabase;

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

    public function test_it_hasMany_stocks() // 25-product-stock-blocks
    {
        $productVariation = ProductVariation::factory()->create();
        $productVariation->stocks()->save(
            Stock::factory()->make()
        );

        $this->assertInstanceOf(Stock::class, $productVariation->stocks->first());
    }

    // 28-product-variation-stock-checks
    public function test_it_has_stock_information()
    {
        $productVariation = ProductVariation::factory()->create();
        $productVariation->stocks()->save(
            Stock::factory()->make()
        );
        $this->assertInstanceOf(ProductVariation::class, $productVariation->stock->first());
    }

    public function test_it_has_stock_count_pivot_within_stock_information()
    {
        $variation = ProductVariation::factory()->create();
        $variation->stocks()->save(
            Stock::factory()->create(['quantity' => $quantity = 5])
        );

        $this->assertEquals($variation->stock->first()->pivot->stock, $quantity);
    }

    public function test_it_has_in_stock_pivot_within_stock_information()
    {
        $variation = ProductVariation::factory()->create();
        $variation->stocks()->save(
            Stock::factory()->create()
        );

        $this->assertTrue((bool)$variation->stock->first()->pivot->in_stock);
    }

    public function test_it_can_check_if_its_in_stock()
    {
        $productVariation = ProductVariation::factory()->create();
        $productVariation->stocks()->save(
            Stock::factory()->make()
        );
        $this->assertTrue($productVariation->stock->first()->inStock());
    }

    public function test_it_can_get_the_stock_count()
    {
        $productVariation = ProductVariation::factory()->create();
        $productVariation->stocks()->save(
            Stock::factory()->create(['quantity' => 10])
        );
        $productVariation->stocks()->save(
            Stock::factory()->make(['quantity' => 10])
        );
        $this->assertEquals($productVariation->stockCount(), 20);
    }
}
