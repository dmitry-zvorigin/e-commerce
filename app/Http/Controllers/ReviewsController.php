<?php

namespace App\Http\Controllers;

use App\Models\Gallery_review;
use App\Models\Product;
use App\Models\Review;
use App\Models\ReviewComment;
use App\Models\ReviewCommentAppend;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Image;

class ReviewsController extends Controller
{
    public function createReview(string $product) : View
    {
        $product = Product::whereSlug($product)->firstOrFail();
        return view('review.create', ['product' => $product]);
    }

    // Создаем отзыв
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

        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $galleryReview = new Gallery_review();
                $galleryReview->review_id = $review->id;
                $imageName = $image->hashName();

                $image->storeAs('gallery_reviews/images', $imageName);

                $thumbnail = Image::make(storage_path('app/gallery_reviews/images/'. $imageName));
                $thumbnail->resize(200, 200);
                $thumbnailName = 'thumb_' . $imageName;
                $thumbnail->save(storage_path('app/gallery_reviews/thumbnails/' . $thumbnailName));

                $galleryReview->image = $imageName;
                $galleryReview->thumbnail = $thumbnailName;

                $galleryReview->save();
            }
        }

        

        return redirect()->route('catalog.product', ['category' => $product->category->slug,'product' => $product->slug])->with('success', 'Отзыв успешно создан');
    }

    public function createComment (Review $review) : View
    {
        
        return view('review_comment.create', ['review' => $review]);
    }

    // Создаем комментарий к отзыву (Верхний уровень)
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

    public function createAppendComment (Review $review, ReviewComment $commentAppend) : View
    {
        return view();
    }

    // Создаем Ответ на комментарий
    public function storeAppendComment (Request $request) : RedirectResponse
    {
        $request->validate([
            'comment' => 'required|string',
            'review_id' => 'required|integer|exists:reviews,id',
            'parent_comment_id' => 'required|integer|exists:review_comments,id',
        ]);

        $comment_append = new ReviewComment([
            'content' => $request->input('comment'),
        ]);

        $comment_append->user()->associate(auth()->user());

        $parentComment = ReviewComment::find($request->input('parent_comment_id'));
        $comment_append->commentParent()->associate($parentComment);

        $review_id = Review::find($request->input('review_id'));        
        $comment_append->review()->associate($review_id);

        $comment_append->save();

        return redirect()->back()->with('success','Комментарий успешно добавлен');
        
    }

    public function createReplyComment (Review $review, ReviewComment $comment) : View
    {
        return view('review_comment.create_append', ['comment' => $comment, 'review' => $review]);
    }

    // Создаем ответ на ответ 
    public function storeReplyComment(Request $request) : RedirectResponse
    {
        $request->validate([
            'comment' => 'required|string',
            'reply_comment_id' => 'required|integer|exists:review_comments,id',
            'parent_comment_id' => 'required|integer|exists:review_comments,parent_comment_id',
            'review_id' => 'required|integer|exists:reviews,id'
        ]);

        $comment_append = new ReviewComment([
            'content' => $request->input('comment'),
        ]);

        $comment_append->user()->associate(auth()->user());

        $parentComment = ReviewComment::find($request->input('parent_comment_id'));
        $comment_append->commentParent()->associate($parentComment);

        $review_id = Review::find($request->input('review_id'));
        $comment_append->review()->associate($review_id);

        $replyComment = ReviewComment::find($request->input('reply_comment_id'));
        $comment_append->commentReply()->associate($replyComment);

        $comment_append->save();

        return redirect()->back()->with('success','Комментарий успешно добавлен');
    }



    // Подгружаем комментарии у отзывов
    public function loadComments(Review $review) : View
    {
        $comments = $review->comments()->whereNull('parent_comment_id')->get();

        return view('review_comment.partial', ['comments' => $comments, 'review' => $review]);
    }

    // Подгружаем ответы у комментариев
    public function loadCommentsChild(ReviewComment $commentParent) : View
    {
        // try {
            $comments = $commentParent->commentsChildren()->get();
            return view('review_comment.partial_child', ['comments' => $comments, 'commentParent' => $commentParent]);
        // } catch (\Exception $e) {
        //     dd($e->getMessage());
        // }
    }
}
