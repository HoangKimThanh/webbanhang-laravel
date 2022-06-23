<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::getFeaturedProducts();
        return view('pages.home', data: [
            'featuredProducts' => $featuredProducts,
        ]);
    }
}
