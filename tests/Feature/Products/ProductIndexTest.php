<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductIndexTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_it_shows_a_collection_of_products(): void
    {
        $product = Product::factory()->create();
        $this->json('GET', '/api/products')
            ->assertJsonFragment(
                ['slug' => $product->slug]
            );
    }

    public function test_it_has_paginated_data()
    {
        $this->json('GET', '/api/products')
            ->assertJsonStructure(
                ['data', 'links', 'meta']
            );
    }
}
