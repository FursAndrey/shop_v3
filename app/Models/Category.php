<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\dbTranslate;

class Category extends Model
{
    use HasFactory, dbTranslate;

    protected $fillable = [
        'name_ru',
        'name_en',
        'code',
        'description_ru',
        'description_en',
    ];

    public function getNameAttribute()
    {
        $fieldName = $this->translate('name');
        return $this->$fieldName;
    }

    public function getDescriptionAttribute()
    {
        $fieldName = $this->translate('description');
        return $this->$fieldName;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
