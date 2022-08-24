<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\dbTranslate;


class Property extends Model
{
    use HasFactory, dbTranslate;
    
    protected $fillable = [
        'name_ru',
        'name_en',
    ];

    public function propertyOptions()
    {
        return $this->hasMany(PropertyOption::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();;
    }
    
    public function getNameAttribute()
    {
        $fieldName = $this->translate('name');
        return $this->$fieldName;
    }

}
