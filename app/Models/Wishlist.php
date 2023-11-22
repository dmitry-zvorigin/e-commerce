<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
    ];

    public function users() : HasMany
    {
        return $this->hasMany(User::class);
    }

    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }
}
