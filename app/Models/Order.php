<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_name',
        'user_email',
        'description',
        'total_price',
        'currency_code',
        'status',
    ];
    
    public function orderedProducts()
    {
        return $this->hasMany(OrderedProduct::class);
    }
}
