<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'receiver_name',
        'receiver_phone',
        'receiver_email',
        'receiver_province',
        'receiver_district',
        'receiver_ward',
        'receiver_address',
        'receiver_total',
        'payment',
    ];

    public function getIdAttribute()
    {
        return $this->attributes['id'];
    }
}
