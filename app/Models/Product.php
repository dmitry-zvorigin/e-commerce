<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function averageRating() : string
    {
        return number_format($this->reviews()->avg('rating'), 2);
    }

    public function reviewCount() : int
    {
        return $this->reviews()->count();
    }

    // public function scopeFilter($query, array $filters) : Builder
    // {
    //     if (isset($filters['category'])) {
    //         $query->where('category_id', $filters['category']);
    //     }

    //     if (isset($filters['min_price']) && isset($filters['max_price'])) {
    //         $query->whereBetween('price', [$filters['min_price'], $filters['max_price']]);
    //     }

    //     if (isset($filters['color'])) {
    //         $query->where('color', $filters['color']);
    //     }

    //     if (isset($filters['page'])) {
    //         $query->paginate(10, ['*'], 'page', $filters['page']);
    //     }

    //     // Добавьте другие фильтры, если необходимо
    //     return $query;
    // }

    // public function scopeSorting($query, $sorting) : Builder
    // {

    //     if (isset($sorting)) {
    //         $sortOptions = [
    //             'price_asc' => ['price', 'asc'],
    //             'price_desc' => ['price', 'desc'],
    //             'name_asc' => ['name', 'asc'],
    //             'name_desc' => ['name', 'desc'],
    //             'created_at_asc' => ['updated_at', 'asc'],
    //             'created_at_desc' => ['updated_at', 'desc'],
    //         ];

    //         if (array_key_exists($sorting, $sortOptions)) {
    //             $query->orderBy($sortOptions[$sorting][0], $sortOptions[$sorting][1]);
    //         }
    //     }

    //     return $query;
    // }

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
