<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product_characteristic extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'group_id',
        'attribute_name',
        'value_id',
    ];

    protected $with = [
        'group',
        'attribute',
        'value',
    ];

    public function group() : BelongsTo
    {
        return $this->belongsTo(Group_attribute::class);
    }

    public function attribute() : BelongsTo
    {
        return $this->belongsTo(Product_attribute::class);
    }

    public function value() : BelongsTo
    {
        return $this->belongsTo(Attribute_value::class);
    }

}
