<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'name',
        'url',
        'detail',
        'description',
        'old_price',
        'new_price',
        'image_main',
        'images_description',
        'featured',
    ];

    public function setUrlAttribute($value)
    {
        $this->attributes['url'] = Str::slug($this->attributes['name']);
    }

    public function setFeaturedAttribute($value)
    {
        $this->attributes['featured'] = 1;
    }

    public function getImagesDescriptionAttribute()
    {
        return explode(' ', $this->attributes['images_description']);
    }

    public static function getWithCategory()
    {
        return Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->get(['products.*', 'categories.name as category_name']);
    }

    public static function getFeaturedProducts()
    {
        return Product::whereFeatured(1)->get();
    }

    public static function getByCategory($selectedCategory, $sort = 'asc')
    {
        return Product::where('category_id', '=', $selectedCategory->id)
            ->orderBy('old_price', $sort)
            ->paginate(2);
    }
}
