<?php

namespace Tests\Unit\Products;

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
}
