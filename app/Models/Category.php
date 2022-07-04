<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        $this->attributes['url'] = Str::slug($this->attributes['name']);
    }

    public static function getTotalPerCategory()
    {
        return DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->groupBy('categories.id')
            ->get(DB::raw('count(*) as total, categories.*'));
    }
}
