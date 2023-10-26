<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateProduct()
    {
        $data = [
            'name' => 'Test Product',
            'price' => 10.99,
        ];

        $productService = new ProductService();
        $product = $productService->createProduct($data);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals($data['name'], $product->name);
        $this->assertEquals($data['price'], $product->price);
    }

    public function testUpdateProduct()
    {
        $product = Product::factory()->create();

        $data = [
            'name' => 'Update Product Name',
            'price' => 19.99,
        ];

        $productService = new ProductService();
        $updatedProduct = $productService->updateProduct($product, $data);

        $this->assertInstanceOf(Product::class, $updatedProduct);
        $this->assertEquals($data['name'], $updatedProduct->name);
        $this->assertEquals($data['price'], $updatedProduct->price);
    }

    public function testDeleteProduct()
    {
        // Создаем мок-объект модели Product
        $product = Mockery::mock(Product::class);
        $product->shouldReceive('delete')->once(); // Ожидаем, что метод delete будет вызван один раз

        $productService = new ProductService();
        $productService->deleteProduct($product);
    }

    public function testGetProductId()
    {
        $product = Product::factory()->create();

        $productService = new ProductService();
        $retrievedProduct = $productService->getProductById($product->id);

        $this->assertInstanceOf(Product::class, $retrievedProduct);
        $this->assertEquals($product->id, $retrievedProduct->id);
    }

    public function testGetAllProduct()
    {
        Product::factory()->count(10)->create();

        $productService = new ProductService();
        $products = $productService->getAllProduct();

        $this->assertInstanceOf(Collection::class, $products);
        $this->assertCount(10, $products);
    }

    public function testGetAllProductsSorted()
    {
        Product::factory()->create(['price' => 20]);
        Product::factory()->create(['price' => 10]);
        Product::factory()->create(['price' => 30]);

        $productService = new ProductService();

        $productAsc = $productService->getAllProductsSorted('price', 'asc');
        $this->assertInstanceOf(Collection::class, $productAsc);
        $this->assertCount(3, $productAsc);
        $this->assertEquals(10, $productAsc->first()->price);

        $productsDesc = $productService->getAllProductsSorted('price', 'desc');
        $this->assertInstanceOf(Collection::class, $productsDesc);
        $this->assertCount(3, $productsDesc);
        $this->assertEquals(30, $productsDesc->first()->price);
    }
}
