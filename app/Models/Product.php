<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'name',
        'detail',
        'description',
        'old_price',
        'new_price',
        'image_main',
        'images_description',
        'featured',
    ];

    public function setFeaturedAttribute($value)
    {
        $this->attributes['featured'] = $value ? 1 : 0;
    }

    public function getImagesDescriptionAttribute()
    {
        return explode(' ', $this->attributes['images_description']);
    }

    public function getDetailAttribute()
    {
        return nl2br($this->attributes['detail']);
    }
}
