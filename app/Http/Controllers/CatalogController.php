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
    )
    {
        $this->ratingService = $ratingService;
    }
    public function catalog() : View
    {
        $categories = Category::all();
        return view('catalog.catalog', ['categories' => $categories]);
    }

    public function category($category) : View
    {
        $category = Category::where('slug', $category)->first();
        // $categories = Category::find($category->category_id);
        return view('catalog.categories', ['category' => $category]);
    }

    public function product($category, $product) : View
    {
        $product = Product::where('slug', $product)->first();
        // $product = Product::find($product->id);
        $product->characteristics = $product->characteristics->groupBy('group_id');
        $ratings = $this->ratingService->calculateRatingPercentage($product);


        return view('catalog.product', ['product'=> $product, 'category' => $category, 'ratings' => $ratings]);
    }
}
