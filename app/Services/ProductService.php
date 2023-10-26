<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function createProduct(array $data)
    {
        //TODO Логика создания товара
        return Product::create($data);
    }

    public function updateProduct(Product $product, array $data) : Product
    {
        //TODO Логика обновления товара
        $product->update($data);
        return $product;
    }

    public function deleteProduct(Product $product)
    {
        //TODO Логика удаления товара
        $product->delete();
    }

    public function getProductById(int $productId)
    {
        //TODO Логика получения информации о товаре по ID
        $product = Product::find($productId);
        return $product;
    }

    public function getAllProduct() : Collection
    {
        //TODO Логика получения списка всех товаров
        return Product::all();
    }
}
