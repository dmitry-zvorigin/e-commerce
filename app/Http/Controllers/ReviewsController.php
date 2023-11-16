<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\ReviewComment;
use App\Models\ReviewCommentAppend;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class ReviewsController extends Controller
{
    public function createReview(string $product) : View
    {
        $product = Product::whereSlug($product)->firstOrFail();
        return view('review.create', ['product' => $product]);
    }

    public function storeReview(Request $request, Product $product) : RedirectResponse
    {
        // dd($product);
        $request->validate([
            'dignities' => 'nullable|string',
            'disadvantages' => 'nullable|string',
            'comment' => 'nullable|string',
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

    public function createComment (Review $review) : View
    {
        
        return view('review_comment.create', ['review' => $review]);
    }

    public function storeComment(Request $request, Review $review) : RedirectResponse
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $comment = new ReviewComment([
            'content' => $request->input('comment'),
        ]);

        $comment->user()->associate(auth()->user());
        $review->comments()->save($comment);

        return redirect()->back()->with('success','Комментарий успешно добавлен');
    }

    public function createCommentAppend (ReviewComment $comment) : View
    {
        
        return view('review_comment.create_append', ['comment' => $comment]);
    }

    public function storeCommentAppend(Request $request, ReviewComment $comment) : RedirectResponse
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $comment_append = new ReviewCommentAppend([
            'content' => $request->input('comment'),
        ]);

        $comment_append->user()->associate(auth()->user());
        $comment->commentAppend()->save($comment_append);

        return redirect()->back()->with('success','Комментарий успешно добавлен');
    }
}
