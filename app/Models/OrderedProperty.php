<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderedProperty extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'ordered_product_id',
        'property_name_ru',
        'property_name_en',
        'option_name_ru',
        'option_name_en',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
