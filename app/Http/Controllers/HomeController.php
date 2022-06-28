<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        // Session::forget('cart_total');
        // Session::save();
        // Session::forget('cart');
        // Session::save();
        // $cart = Session::get('cart');
        // dd($cart);
        $cart = Session::get('cart_total');
        dd(Session::all());
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

    public function order()
    {
        $user = Auth::guard('user')->check() ? User::find(Auth::guard('user')->user()->id) : null;
        $cart = Session::get('cart');
        return view('pages.order', compact('cart', 'user'));
    }
}
