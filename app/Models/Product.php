<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'detail',
        'slug',
        'price',
    ];

    protected $with = [
        'images'
    ];

    public function toSearchableArray() : array
    {
        return [
            'name' => $this->name,
            'description'=> $this->description,
            'detail' => $this->detail,
        ];
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews() : HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function characteristics() : HasMany
    {
        return $this->hasMany(Product_characteristic::class);
    }

    public function images() : HasMany
    {
        return $this->hasMany(Gallery_product::class);
    }

    // Подсчет среднего значения, на основе оценок
    public function averageRating() : string
    {
        return number_format($this->reviews()->avg('rating'), 2);
    }

    // Подсчет колличества отзывов для продукта
    public function reviewCount() : int
    {
        return $this->reviews()->count();
    }

    // Получаем все изображения из отзывов
    public function galleryReviewsAll() : HasManyThrough
    {
        return $this->hasManyThrough(Gallery_review::class, Review::class, 'product_id', 'review_id');
    }

    // Мутатор для времени
    public function getCreatedAtAttribute($value) : string
    {
        return Carbon::parse($value)->format('H:i:s d-m-Y');
    }

    // Мутатор для времени
    public function getUpdatedAtAttribute($value) : string
    {
        return Carbon::parse($value)->format('H:i:s d-m-Y');
    }
}
