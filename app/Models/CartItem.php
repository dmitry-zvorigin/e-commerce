<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart';
    protected $fillable = ['user_id','product_id', 'quantity'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getTotalAttribute()
    {
        return $this->quantity * $this->product->price;
    }

    public static function getSumAttribute()
    {
        $cartItems = self::all();

        $total = 0;

        foreach ($cartItems as $cartItem) {
            $total += $cartItem->total;
        }

        return $total;
    }
}
