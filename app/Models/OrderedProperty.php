<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\dbTranslate;

class OrderedProperty extends Model
{
    use HasFactory, dbTranslate;
    
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
    
    public function getPropertyNameAttribute()
    {
        $fieldName = $this->translate('property_name');
        return $this->$fieldName;
    }

    public function getOptionNameAttribute()
    {
        $fieldName = $this->translate('option_name');
        return $this->$fieldName;
    }

}
