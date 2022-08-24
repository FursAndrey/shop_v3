<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\dbTranslate;

class Role extends Model
{
    use HasFactory, dbTranslate;
    
    protected $fillable = [
        'name_ru',
        'name_en',
        'description_ru',
        'description_en',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    
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

}
