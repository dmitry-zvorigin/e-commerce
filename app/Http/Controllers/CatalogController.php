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

        // $sort = [
        //     "sortingDate" => '',
        //     "sortingRating" => '',
        //     "sortingPopular" => '',
        //     "sortingEdit" => ''
        // ];
        if ($request->hasAny(['search', 'sorting', 'ratings'])) {

            $query = $request->input('search', '');

            $product->reviews = Review::search($query, function ($meilsearch, string $query, array $options) use ($product, $request) {
                $options['filter'] = 'product_id=' . $product->id;


                if ($request->filled('ratings')) {
                    $ratings = $request->input('ratings');
                    $options['filter'] .= ' AND (' . implode(' OR ', array_map(function ($rating) {
                        return 'rating=' . $rating;
                    }, $ratings)) . ')';
                }

                if ($request->filled('sorting')) {
                    $sorting = $request->input('sorting');
                    switch ($sorting) {
                        case 'sortingDate':
                            $options['sort'] = ['created_at:asc'];
                            break;
                        case 'sortingRating':
                            $options['sort'] = ['rating:desc'];
                            break;
                        case 'sortingPopularity':
                            $options['sort'] = ['likes:desc'];
                            break;
                        case 'sortingEdit':
                            $options['sort'] = ['updated_at:asc'];
                            break;
                    }
                    // $options['sort'] = ['rating:desc'];
                }



                return $meilsearch->search($query, $options);
            })->paginate(5);

        } else {
            $product->reviews = $product->reviews()->paginate(5);
        }

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
