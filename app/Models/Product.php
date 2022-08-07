<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name_ru',
        'name_en',
        'description_ru',
        'description_en',
        'img',
        'category_id',
    ];
    
    public function setImgAttribute($imgUrl)
    {
        $this->attributes['img'] = preg_replace('/^[A-Za-z0-9_]+\/{1}/', '', $imgUrl);
    }
    
    public function getImgForDeleteAttribute()
    {
        if ($this->img == 'test.jpg') {
            return 'no_delete_this_file';
        } else {
            return public_path('/storage/uploads/'.str_replace('/', '\\', $this->img));
        }
    }
    
    public function getImgForViewAttribute()
    {
        return '/storage/uploads/'.$this->img;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class)->withTimestamps();;
    }
}