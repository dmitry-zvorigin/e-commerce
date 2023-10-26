<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testShowMethod()
    {
        $product = Product::factory()->create();
        $response = $this->get(route('products.show', ['product' => $product]));

        $response->assertViewIs('products.product');
        $response->assertViewHas('product', $product);
    }

    public function testIndexMethod()
    {
        $products = Product::factory()->count(5)->create();

        $response = $this->get(route('products.index'));

        $response->assertViewIs('products.products');
        $response->assertViewHas('products', $products);
    }

    public function testStoreMethod()
    {
        $data = [
            'name' => $this->faker->name,
            'price' => $this->faker->randomNumber(2),
        ];

        $response = $this->post(route('products.store'), $data);

        $response->assertRedirect();
        $this->assertDatabaseHas('products', $data);
    }

    public function testUpdateMethod()
    {
        $product = Product::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'price' => $this->faker->randomNumber(2),
        ];

        $response = $this->put(route('products.update', ['product' => $product->id]), $data);

        $response->assertRedirect();
        $this->assertDatabaseHas('products', $data);
    }

    public function testDestroyMethod()
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('products.destroy', ['product' => $product]));

        $response->assertRedirect();
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function testEditMethod()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.edit', ['product' => $product->id]));

        $response->assertViewIs('products.edit');
        $response->assertViewHas('product', $product);
    }

    public function testCreateMethod()
    {
        $response = $this->get(route('products.create'));

        $response->assertViewIs('products.create');
    }

    public function testProductsAreSortedByPriceInAscendingOrder()
    {
        Product::factory()->create(['price' => 100]);
        Product::factory()->create(['price' => 50]);
        Product::factory()->create(['price' => 200]);

        $response = $this->get(route('products.index', ['sort_by' => 'price', 'sort_order' => 'asc']));

        $response->assertSuccessful();

        $response->assertSeeInOrder([50, 100, 200]);
    }

    public function testProductsAreSortedByNameInDescendingOrder()
    {
        Product::factory()->create(['name' => 'Product C']);
        Product::factory()->create(['name' => 'Product A']);
        Product::factory()->create(['name' => 'Product B']);

        $response = $this->get(route('products.index', ['sort_by' => 'name', 'sort_order' => 'asc']));

        $response->assertSuccessful();

        $response->assertSeeInOrder(['Product A', 'Product B', 'Product C']);
    }
}
