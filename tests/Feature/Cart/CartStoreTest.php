<?php

namespace Tests\Feature\Cart;

use Tests\TestCase;
use App\Models\User;
use App\Models\ProductVariation;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartStoreTest extends TestCase
{
    // video #41
    public function test_it_fails_if_unauthenticated()
    {
        $this->json('POST', 'api/cart')
            ->assertStatus(401);
    }

    // need the token
    public function test_it_requires_products()
    {
        $response = $this->json('POST', 'api/cart', [
            'products' => []
        ]);
        dd($response->getContent());
        // ->assertJsonValidationErrors(['products']);
    }

    public function test_it_can_add_products_to_the_users_cart()
    {
        $user = User::factory()->create();
        $product = ProductVariation::factory()->create();

        $response = $this->json('POST', 'api/cart', [
            'products' => [
                'id' => $product->id,
                'quantity' => 2
            ]
        ]);
        dd($response->getContent());
        $this->assertDatabaseHas('cart_user', [
            'product_variation_id' => $product->id,
            'quantity' => 2
        ]);
    }
}
