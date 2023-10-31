<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\RatingService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class CatalogController extends Controller
{
    public function __construct(
        private RatingService $ratingService,
    ) {
        $this->ratingService = $ratingService;
    }
    public function catalog() : View
    {
        $categories = Category::all();
        return view('catalog.catalog', ['categories' => $categories]);
    }

    public function category(string $category) : View
    {
        $category = Category::where('slug', $category)->first();
        $products = $category->products;
        $products = $products->map(function ($product) {
            $product->rating = $product->averageRating();
            return $product;
        });

        // dd($products);

        return view('catalog.categories', ['category' => $category]);
    }

    public function product(string $category, string $product, Request $request) : View
    {
        dump($request);
        $product = Product::with(['category', 'reviews.user'])->where('slug', $product)->first();

        $product->characteristics = $product->characteristics->groupBy('group_id');
        $product->averageRating = $product->averageRating();
        $product->RatingPercentage = $this->ratingService->calculateRatingPercentage($product);

        $product->reviews = $product->reviews()->paginate(5);


        return view('catalog.product', ['product'=> $product, 'category' => $category,]);
    }
}
