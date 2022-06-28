<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $table = 'invoice_product';

    protected $fillable = [
        'invoice_id',
        'product_id',
        'quantity',
        'price',
    ];

    public static function getInvoiceDetails($invoiceId)
    {
        $invoiceDetails = DB::table('invoice_product')
            ->join('products', 'invoice_product.product_id', '=', 'products.id')
            ->where('invoice_product.invoice_id', $invoiceId)
            ->get();
        return $invoiceDetails;
    }
}
