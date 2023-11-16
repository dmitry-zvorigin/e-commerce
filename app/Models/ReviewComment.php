<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReviewComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'review_id',
        'content',
    ];

    protected $casts = [
        'publish' => 'boolean',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function review() : BelongsTo
    {
        return $this->belongsTo(Review::class);
    }

    public function commentsAppend() : HasMany
    {
        return $this->hasMany(ReviewCommentAppend::class, 'review_comment_id');
    }

    public function parentComment() : BelongsTo
    {
        return $this->belongsTo(ReviewComment::class, 'review_id');
    }
}
