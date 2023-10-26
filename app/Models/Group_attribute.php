<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group_attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function product_attribute() : HasMany
    {
        return $this->hasMany(Product_attribute::class, 'group_id');
    }
}
