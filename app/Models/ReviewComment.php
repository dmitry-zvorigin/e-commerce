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
        'parent_comment_id',
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

    public function commentParent() : BelongsTo
    {
        return $this->belongsTo(ReviewComment::class, 'parent_comment_id');
    }

    public function commentsChildren() : HasMany
    {
        return $this->hasMany(ReviewComment::class, 'parent_comment_id');
    }

    public function commentReply() : BelongsTo
    {
        return $this->belongsTo(ReviewComment::class,'reply_comment_id');
    }


}
