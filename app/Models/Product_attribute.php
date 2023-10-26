<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product_attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribute_name',
        'group_id',
    ];

    public function group_attribute() : BelongsTo
    {
        return $this->belongsTo(Group_Attribute::class, 'group_id');
    }

    public function attribute_value() : HasMany
    {
        return $this->hasMany(Attribute_value::class, 'attribute_id');
    }
}
