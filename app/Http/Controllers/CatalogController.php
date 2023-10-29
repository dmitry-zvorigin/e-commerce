<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class CatalogController extends Controller
{
    public function catalog() : View
    {
        $categories = Category::all();
        return view('catalog.catalog', ['categories' => $categories]);
    }

    public function caregory(Category $category) : View
    {
        $categories = Category::find($category->category_id);

        return view('catalog.categories', ['categories' => $categories]);
    }

    public function product(Product $product) : View
    {
        $product = Product::find($product->id);

        return view('catalog.product', ['product'=> $product]);
    }
}
