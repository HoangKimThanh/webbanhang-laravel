<?php

namespace App\Models;

use App\Services\UrlService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'url',
    ];

    public function setUrlAttribute($value)
    {
        $this->attributes['url'] = UrlService::makeUrl($this->attributes['name']);
    }

    public static function getTotalPerCategory()
    {
        return DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->groupBy('categories.id')
            ->get(DB::raw('count(*) as total, categories.*'));
    }
}
