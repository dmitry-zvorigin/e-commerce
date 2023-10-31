<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Gallery_product;
use App\Models\Group_attribute;
use App\Models\Product_characteristic;
use App\Models\Review;
use App\Services\ProductFilterService;
use App\Services\ProductService;
use App\Services\ProductSortingService;
use App\Services\RatingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService,
        private ProductFilterService $productFilterService,
        private ProductSortingService $productSortingService,
    ) {
        $this->productFilterService = $productFilterService;
        $this->productSortingService = $productSortingService;
    }


    public function show(string $slug) : View
    {
        $product = Product::whereSlug($slug)->firstOrFail();
        $product->characteristics = $product->characteristics->groupBy('group_id');
        return view('products.show', ['product' => $product]);
    }


    public function index(Request $request) : View
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            $products = Product::search($search)->paginate(10);
        } else {
            $products = Product::with('category')->paginate(10);
        }


        return view('products.index', ['products' => $products]);
    }

    public function create() : View
    {
        $categories = Category::all();

        return view('products.create', ['categories' => $categories]);
    }

    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'detail' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'images' => 'array|max:4',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->slug = Str::slug($request->input('name'));
        $product->description = $request->input('description');
        $product->detail =  $request->input('detail');
        $product->category_id = $request->input('category_id');
        $product->price = $request->input('price');

        $product->save();

        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $galleryProduct = new Gallery_product();
                $galleryProduct->product_id = $product->id;
                $imageName = $image->hashName();

                $image->storeAs('gallery_products/images', $imageName);

                $thumbnail = Image::make(storage_path('app/gallery_products/images/' . $imageName));
                $thumbnail->resize(200, 200);
                $thumbnailName = 'thumb_' . $imageName;
                $thumbnail->save(storage_path('app/gallery_products/thumbnails/'. $thumbnailName));

                $galleryProduct->image = $imageName;
                $galleryProduct->thumbnail = $thumbnailName;

                $galleryProduct->save();

                // $galleryProduct->thumbnail = $image->hashName();
                // $galleryProduct->save();
                // $image->storeAs('gallery_products/images', $image->hashName());
                // $image->storeAs('gallery_products/thumbnail', $image->hashName());
            }
        }

        return redirect()->route('admin.products.show', ['product' => $product->slug])->with('success', 'Продукт успешно создан');
    }


    public function edit(string $slug) : View
    {
        $categories = Category::all();

        $product = Product::whereSlug($slug)->firstOrFail();
        $product->characteristics = $product->characteristics->groupBy('group_id');

        $groupAttributes = Group_attribute::all();

        return view('products.edit', ['product' => $product, 'categories' => $categories, 'groupAttributes' => $groupAttributes]);
    }

    public function update(Request $request, Product $product) : RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'detail' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'images' => 'array|max:4',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product->name = $request->input('name');
        $product->slug = Str::slug($request->input('name'));
        $product->description = $request->input('description');
        $product->detail =  $request->input('detail');
        $product->category_id = $request->input('category_id');
        $product->price = $request->input('price');

        $product->update();

        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $galleryProduct = new Gallery_product();
                $galleryProduct->product_id = $product->id;
                $imageName = $image->hashName();

                $image->storeAs('gallery_products/images', $imageName);

                $thumbnail = Image::make(storage_path('app/gallery_products/images/' . $imageName));
                $thumbnail->resize(200, 200);
                $thumbnailName = 'thumb_' . $imageName;
                $thumbnail->save(storage_path('app/gallery_products/thumbnails/'. $thumbnailName));

                $galleryProduct->image = $imageName;
                $galleryProduct->thumbnail = $thumbnailName;

                $galleryProduct->save();
            }
        }

        return redirect()->route('admin.products.edit', ['product' => $product->slug])->with('success', 'Продукт успешно изменен');
    }

    public function destroy(Product $product) : RedirectResponse
    {
        foreach ($product->images as $image) {
            Storage::delete('gallery_products/images/' . $image->image);
            Storage::delete('gallery_products/thumbnails/' . $image->thumbnail);

            $image->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Продукт успешно удален');
    }

    public function destroyImage(Gallery_product $image) : RedirectResponse
    {
        Storage::delete('gallery_products/images/' . $image->image);
        Storage::delete('gallery_products/thumbnails/'. $image->thumbnail);

        $image->delete();

        return redirect()->back()->with('success', 'Изображение удалено успешно');
    }

    public function destroyCharacteristics(Product_characteristic $characteristics) : RedirectResponse
    {
        $characteristics->delete();

        return redirect()->back()->with('success','Характеристика успешно удалена');
    }


    public function createReview(string $product) : View
    {
        $product = Product::whereSlug($product)->firstOrFail();
        return view('review.create', ['product' => $product]);
    }

    public function storeReview(Request $request, Product $product) : RedirectResponse
    {
        // dd($product);
        $request->validate([
            'dignities' => 'string',
            'disadvantages' => 'string',
            'comment' => 'string',
            'rating' => 'required|numeric|min:1|max:5',
            'images' => 'array|max:4',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $review = new Review([
            'dignities' => $request->input('dignities'),
            'disadvantages' => $request->input('disadvantages'),
            'comment' => $request->input('comment'),
            'rating' => $request->input('rating'),
        ]);

        $review->user()->associate(auth()->user());
        $review->product()->associate($product);
        $review->save();

        return redirect()->route('catalog.product', ['category' => $product->category->slug,'product' => $product->slug])->with('success', 'Отзыв успешно создан');
    }











    // public function show(Product $product) : View
    // {
    //     return view('products.product', compact('product'));
    // }



    // public function index(ProductRequest $request) : View
    // {
    //     $filters = $request->safe()->only('color', 'category', 'min_price', 'max_price');
    //     $sorting = $request->validated('sorting');

    //     $categories = Category::all();
    //     $colors = Product::distinct()->pluck('color');

    //     // $products = Product::with('category')->filter($filters)->sorting($sorting)->paginate(10);

    //     $query = Product::query();
    //     $this->productFilterService->applyFilters($query, $filters);
    //     $this->productSortingService->applySorting($query, $sorting);
    //     $products = $query->with('category')->paginate(10);

    //     return view('products.products', compact('products', 'categories', 'colors'));
    // }



    // public function store(ProductCreateRequest $productCreateRequest) : RedirectResponse
    // {
    //     $data = $productCreateRequest->validated();
    //     $product = $this->productService->createProduct($data);

    //     return redirect()->route('products.show', compact('product'));
    // }

    // public function update(ProductUpdateRequest $productUpdateRequest, Product $product) : RedirectResponse
    // {
    //     $data = $productUpdateRequest->validated();
    //     $product = $this->productService->updateProduct($product, $data);

    //     return redirect()->route('products.show', compact('product'));
    // }

    // public function edit(Product $product) : View
    // {
    //     return view('products.edit', compact('product'));
    // }

    // public function destroy(Product $product) : RedirectResponse
    // {
    //     $this->productService->deleteProduct($product);

    //     return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    // }

    // public function create() : View
    // {
    //     $categories = Category::all();

    //     return view('products.create', compact('categories'));
    // }
}
