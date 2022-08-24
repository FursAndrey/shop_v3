<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\dbTranslate;

class PropertyOption extends Model
{
    use HasFactory, dbTranslate;
    
    protected $fillable = [
        'name_ru',
        'name_en',
        'property_id',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function skus()
    {
        return $this->belongsToMany(Sku::class)->withTimestamps();;
    }
    
    public function getNameAttribute()
    {
        $fieldName = $this->translate('name');
        return $this->$fieldName;
    }

}
