<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
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
        // dump($request);


        // $product = Product::with(['category', 'reviews.user'])->where('slug', $product)->first();
        $product = Product::whereSlug($product)->with(['category', 'reviews.user'])->firstOrFail();
        $product->characteristics = $product->characteristics->groupBy('group_id');
        $product->averageRating = $product->averageRating();
        $product->RatingPercentage = $this->ratingService->calculateRatingPercentage($product);


        if ($query = $request->get('search')) {
            $product->reviews = Review::search('их нет', function ($meilsearch, string $query, array $options) use ($product) {
                $options['filter'] = 'product_id=' . $product->id;
                // $options['sort'] = ['rating:desc'];

                return $meilsearch->search($query, $options);
            })->orderBy('rating', 'asc')
            ->paginate(5);

            dump($product->reviews);
        } else {
            $product->reviews = $product->reviews()->paginate(5);
        }

        // if ($query = $request->get('search')) {
        //     $product->reviews = Review::search($query, function($meilsearch, $query, $options) use ($product) {
        //         $options['filter'] = 'product_id='.$product->id;
        //         $options['sort'] = ['rating:asc'];
        //         return $meilsearch->search($query, $options);
        //     })
        //         ->where('product_id', $product->id)
        //         ->paginate(5);
        // } else {
        //     $product->reviews = $product->reviews()->paginate(5);
        // }



        // if ($request->has('search')) {
        //     $search = $request->input('search');

        //     $product->reviews = Review::search($search)->where('product_id', $product->id)->paginate(5);
        // } else {
        //     $product->reviews = $product->reviews()->paginate(5);
        // }

        // dump($product->reviews);


        return view('catalog.product', ['product'=> $product, 'category' => $category,]);
    }
}
