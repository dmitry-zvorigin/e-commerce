<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Category extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['name'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Category $category) {
            $category->slug = $category->getSlugAttribute();
        });

    }

    public function getSlugAttribute() : string
    {
        $originSlug = Str::slug($this->name);
        $slug = $originSlug;
        $counter = 2;

        while (Category::where('slug', $slug)->where('id', '!=' , $this->id)->exists()) {
            $slug = $originSlug . '-' . $counter;
            $counter++;
        }

        return $slug;

        // return Str::slug($this->name);
    }

    public function toSearchableArray() : array
    {
        return [
            'name' => $this->name,
        ];
    }

    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }
}
