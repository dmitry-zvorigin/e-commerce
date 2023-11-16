<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReviewCommentAppend extends Model
{
    use HasFactory;

    protected $table = 'review_comments_appends';

    protected $fillable = [
        'user_id',
        'reviews_comment_id',
        'content',
    ];

    protected $casts = [
        'publish' => 'boolean',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comment() : BelongsTo
    {
        return $this->belongsTo(ReviewComment::class, 'review_comment_id');
    }

}
