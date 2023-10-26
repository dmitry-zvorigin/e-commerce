<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'dignities',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
