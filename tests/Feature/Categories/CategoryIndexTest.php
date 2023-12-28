<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_it_returns_a_collection_of_categories(): void
    {
        $categories = Category::factory(2)->create();
        $response = $this->json('GET', '/api/categories');

        $categories->each(function ($category) use ($response) {
            $response->assertJsonFragment([
                'slug' => $category->slug
            ]);
        });

        // $this->json('GET', '/api/categories')
        //     ->assertJsonFragment(
        //         [
        //             'name' => $categories->get(0)->name,
        //             'slug' => $categories->get(1)->slug,
        //         ],
        //         [
        //             'name' => $categories->get(1)->name,
        //             'slug' => $categories->get(1)->slug
        //         ]
        //     );
    }

    public function test_it_returns_only_parents_categories()
    {
        $category = Category::factory()->create();
        $category->children()->save(
            Category::factory()->create()
        );
        $this->json('GET', '/api/categories')
            ->assertJsonCount(1, 'data');
    }

    public function test_it_returns_categories_ordered_by_their_given_order()
    {
        $category = Category::factory()->create(['order' => 2]);
        $anotherCategory = Category::factory()->create([
            'order' => 1
        ]);

        $this->json('GET', '/api/categories')
            ->assertSeeInOrder([$anotherCategory->name, $category->name]);
    }
}
