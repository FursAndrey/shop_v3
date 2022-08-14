<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'price',
        'count',
        'product_id',
        'currency_id',
    ];

    protected $visible = [
        'price', 
        'count',
        'product_id', 
        'currency_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function property_options()
    {
        return $this->belongsToMany(PropertyOption::class)->withTimestamps();
    }
}
