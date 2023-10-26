<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Логика получения суммы товара
    public function getTotalAttribute() : float
    {
        return $this->quantity * $this->product->price;
    }

    // Логика получения Итого
    public static function getSumAttribute() : float
    {
        $cartItems = self::all();

        $total = 0;

        foreach ($cartItems as $cartItem) {
            $total += $cartItem->total;
        }

        return $total;
    }
}
