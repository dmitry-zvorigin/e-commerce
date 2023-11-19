<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\Test;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishController;
use App\Http\Middleware\StripEmptyParams;
use App\Models\ReviewComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/cart', [CartController::class,'index'])->name('cart');
Route::get('/wishlist', [WishController::class,'index'])->name('wishlist');

Route::get('/review/{product}/create', [ReviewsController::class, 'createReview'])->name('review.create');
Route::post('/review/{product}/store', [ReviewsController::class,'storeReview'])->name('review.store');

Route::get('/reviews/{review}/comments/create', [ReviewsController::class,'createComment'])->name('review.comment.create');
Route::post('/reviews/{review}/comments/store', [ReviewsController::class,'storeComment'])->name('review.comment.store');

Route::post('reviews/{review}/commentsAppend/{comment}/store', [ReviewsController::class,'storeAppendComment'])->name('review.comment.append.store');

Route::get('/reviews/{review}/commentsReply/{comment}/create', [ReviewsController::class,'createReplyComment'])->name('review.comment.reply.create');
// Route::post('/reviews/{review}/commentsReply/{comment}/store', [ReviewsController::class,'storeReplyComment'])->name('review.comment.reply.store');
Route::post('/store-comments/', [ReviewsController::class,'storeReplyComment'])->name('review.comment.reply.store');

Route::get('/load-comments/{review}', [ReviewsController::class,'loadComments'])->name('load.comments');
Route::get('/load-comments-child/{commentParent}', [ReviewsController::class,'loadCommentsChild'])->name('load.comments.child');

Route::group(['prefix' => 'catalog'], function () {
    Route::get('/', [CatalogController::class,'catalog'])->name('catalog');
    Route::get('/{catagory}', [CatalogController::class,'category'])->name('catalog.category');
    Route::get('/{category}/{product}', [CatalogController::class,'product'])->name('catalog.product');
});

Route::group(['prefix'=> 'categories'], function () {
    Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/', [CategoryController::class, 'store'])->name('admin.categories.store');

    Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/{category}', [CategoryController::class,'show'])->name('admin.categories.show');

    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');

    Route::delete('/{category}', [CategoryController::class,'destroy'])->name('admin.categories.destroy');
});

Route::group(['prefix' => 'products'], function () {

    Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/', [ProductController::class, 'store'])->name('admin.products.store');

    Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/{product}', [ProductController::class, 'show'])->name('admin.products.show');

    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/{product}', [ProductController::class, 'update'])->name('admin.products.update');

    Route::get('/{product}/create-attributes', [AttributeController::class,'createAttributes'])->name('admin.products.createAttributes');
    Route::post('/{product}/save-attributes', [AttributeController::class, 'saveAttributes'])->name('admin.products.saveAttributes');


    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::delete('/images/{image}', [ProductController::class, 'destroyImage'])->name('admin.products.destroyImage');

    Route::delete('/characteristics/{characteristics}', [ProductController::class,'destroyCharacteristics'])->name('admin.products.destroyCharacteristics');


});

Route::group(['prefix'=> 'users'], function () {
    Route::get('/', [UserController::class,'index'])->name('admin.user.index');
});

Route::group(['prefix' => 'attributes'], function () {
    Route::get('/', [AttributeController::class,'index'])->name('admin.attribute.index');

    Route::get('/load-attributes', [AttributeController::class, 'loadAttributes'])->name('admin.attributes.loadAttributes');
    Route::get('/load-values', [AttributeController::class, 'loadValue'])->name('admin.attributes.loadValue');


    Route::post('/create-group', [AttributeController::class, 'createGroupAttribute'])->name('admin.attribute.createGroup');
    Route::post('/create-attributes', [AttributeController::class, 'createAttribute'])->name('admin.attribute.createAttribute');
    Route::post('/create-value', [AttributeController::class,'createValue'])->name('admin.attribute.createValue');

    // Route::get('/group/create', [AttributeController::class,'createGroup'])->name('admin.attributes.createGroup');
    Route::post('/group/store', [AttributeController::class, 'storeGroup'])->name('admin.attributes.storeGroup');

    // Route::get('/attribute/create', [AttributeController::class,'createAttribute'])->name('admin.attributes.createAttribute');
    Route::post('/attribute/store', [AttributeController::class, 'storeAttribute'])->name('admin.attributes.storeAttribute');

    // Route::get('/value/create', [AttributeController::class,'createValue'])->name('admin.attributes.createValue');
    Route::post('/value/store', [AttributeController::class, 'storeValue'])->name('admin.attributes.storeValue');

});

Auth::routes();

Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::get('/admin/dashboard', [DashboardController::class,'index'])->name('admin.dashboard');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');












// Route::prefix('products')->group(function () {


//     Route::get('/create', [ProductController::class, 'create'])->name('products.create');
//     Route::post('/', [ProductController::class, 'store'])->name('products.store');

//     Route::get('/', [ProductController::class, 'index'])->middleware(StripEmptyParams::class)->name('products.index');
//     Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');

//     Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
//     Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');

//     Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

//     // Route::get('/filterByColor', [ProductController::class, 'filterByColor'])->name('products.filterByColor');
//     // Route::get('/filterByPriceRange', [ProductController::class, 'filterByPriceRange'])->name('products.filterByPriceRange');
// });


// Route::prefix('cart')->group(function () {
//     Route::get('/', [CartController::class, 'index'])->name('cart.index');
//     Route::post('/', [CartController::class, 'store'])->name('cart.addToCart');
//     Route::patch('/{id}', [CartController::class, 'update'])->name('cart.updateCart');
//     Route::delete('/{id}', [CartController::class, 'destroy'])->name('cart.removeFromCart');
// });
