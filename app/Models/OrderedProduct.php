<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderedProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'sku_id',
        'name_ru',
        'name_en',
        'count',
        'price_for_once',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function orderedProperties()
    {
        return $this->hasMany(OrderedProperty::class);
    }
}
