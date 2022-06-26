<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        Session::forget('cart');
        Session::save();
        $cart = Session::get('cart');
        dd($cart);
        $featuredProducts = Product::getFeaturedProducts();
        return view('pages.home', data: [
            'featuredProducts' => $featuredProducts,
        ]);
    }

    public function intro()
    {
        return view('pages.intro');
    }

    public function news()
    {
        return view('pages.news');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function register()
    {
        return view('pages.register');
    }

    public function login()
    {
        return view('pages.login');
    }

    public function cart()
    {
        $cart = Session::has('cart') ? Session::get('cart') : null;
        return view('pages.cart', compact('cart'));
    }
}
