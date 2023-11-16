<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Meilisearch\Endpoints\Indexes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Review extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'user_id',
        'product_id',
        'dignities',
        'disadvantages',
        'comment',
        'real_buy',
        'rating',
    ];

    protected $casts = [
        'real_buy' => 'boolean',
        'publish' => 'boolean',
    ];


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function comments() : HasMany
    {
        return $this->hasMany(ReviewComment::class);
    }

    public function getCreatedAtAttribute($value) : string
    {
        return Carbon::parse($value)->format('H:i:s d-m-Y');
    }

    public function getUpdatedAtAttribute($value) : string
    {
        return Carbon::parse($value)->format('H:i:s d-m-Y');
    }

    // protected function serializeDate(DateTimeInterface $data) : string
    // {
    //     return $data->created_at->format('Y-m-d');
    // }


    // public function toSearchableArray() : array
    // {
    //     return [
    //         // 'rating' => $this->rating,
    //         // 'product_id' => $this->product_id,
    //         'dignities' => $this->dignities,
    //         'disadvantages' => $this->disadvantages,
    //         'comment' => $this->comment,
    //     ];
    // }

    // public function toSortableAttributes() : array
    // {
    //     return [
    //         'rating'
    //     ];
    // }

    // public function toFilterableAttributes() : array
    // {
    //     return [
    //         'product_id',
    //         'rating'
    //     ];
    // }

    // public function makeAllSearchableUsing(Builder $query)
    // {
    //     $query->with('user_id');
    //     $query->where('product_id', $this->product_id);
    //     return $query;
    // }

    protected function makeAllSearchableUsing(Builder $query): Builder
    {
        return $query->with('user');
    }
}
