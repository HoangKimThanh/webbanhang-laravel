<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'user_name',
        'user_email',
        'content',
        'status',
    ];

    public static function getReviewsWithProductName($status)
    {
        $reviews = DB::table('reviews')
            ->join('products', 'reviews.product_id', '=', 'products.id')
            ->where('reviews.status', '=', $status)
            ->get(DB::raw('reviews.*, products.name as product_name'));

        return $reviews;
    }
}
