<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function ajax(Request $request)
    {
        $action = $request->get('action');
        $id = $request->get('id');
        $quantity = $request->get('quantity');
        switch ($action) {
            case 'add':
                return $this->addToCart($id, $quantity);
                break;

            case 'update':
                return $this->updateCart($id, $quantity);
                break;

            case 'delete':
                return $this->deleteFromCart($id);
                break;

            default:
                # code...
                break;
        }
    }

    public function addToCart($id, $quantity)
    {
        $product = Product::find($id)->toArray();
        $product['price'] = $product['new_price'] ?? $product['old_price'];

        $isExisting = false;

        $cart = array();

        
        $cart_total = Session::get('cart_total') ?? 0;

        if (Session::has('cart')) {
            $cart = Session::get('cart');

            for ($i = 0; $i < count($cart); $i++) {
                if ($cart[$i]['id'] == $id) {
                    $cart_total += $cart[$i]['price'] * $quantity;
                    $cart[$i]['quantity'] += $quantity;

                    Session::put('cart', $cart);
                    $isExisting = true;
                    break;
                }
            }
        }

        if ($isExisting == false) {
            $product['quantity'] = $quantity;
            $cart_total += $product['price'] * $product['quantity'];
            Session::push('cart', $product);
        }

        Session::put('cart_total', $cart_total);

        $cart = Session::get('cart');

        $str = "";

        $str .= '<span>' . count($cart) . '</span>';
        $str .= 'OK';
        $str .= '<p class="cart__list-header">Sản Phẩm Mới Thêm</p>
        <ul class="cart__list-list">';
        foreach ($cart as $item) {
            $str .=  '<li class="cart__list-item">
                    <a href="#" class="cart__list-item-link">
                        <img class="cart__list-item-img" src="' . asset('img/uploads/' . $item['image_main']) . '" alt="">
                        
                        <div class="cart__list-item-description">
                            <div class="cart__list-item-heading">
                                <h4 class="cart__list-item-name">' . $item['name'] . '</h4>
                                
                                <div class="cart__list-item-detail">
                                    <span class="cart__list-item-cost highlight">' . $item['price'] . '</span>
                                    <span class="cart__list-item-multiply">x</span>
                                    <span class="cart__list-item-quanlity">' . $item['quantity'] . '</span>
                                    
                                </div>
                            </div>
                        </div>
                    </a>
                </li>';
        }
        $str .= '</ul>';
        $str .= '<div class="cart__list-footer">
            <a href="' . route('cart') . '" class="btn">Xem Giỏ Hàng</a>
        </div>';

        return response()->json(array(
            'success' => true,
            'str' => $str,
        ));
    }

    public function updateCart($id, $quantity)
    {
        $cart = Session::get('cart');
        $cart_total = Session::get('cart_total');
        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['id'] == $id) {
                $cart_total += $cart[$i]['price'] * ($quantity - $cart[$i]['quantity']);
                $cart[$i]['quantity'] = $quantity;
                Session::put('cart', $cart);
                Session::put('cart_total', $cart_total);
                break;
            }
        }

        return;
    }

    public function deleteFromCart($id)
    {
        $product = Product::find($id)->toArray();
        $product['price'] = $product['new_price'] ?? $product['old_price'];

        $cart = Session::get('cart');
        $cart_total = Session::get('cart_total');

        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['id'] == $id) {
                $cart_total -= $cart[$i]['quantity'] * $cart[$i]['price'];
                Session::put('cart_total', $cart_total);
                unset($cart[$i]);
                $cart = array_values($cart);
                break;
            }
        }

        if (count($cart) == 0) {
            Session::forget('cart');
        } else {
            Session::put('cart', $cart);
        }
        Session::save();

        $str = "";

        if (count($cart) == 0) {
            $str .= 'OK';
            $str .= '<img class="no-cart" src="./assets/img/no_cart.png" alt="">
            <p class="cart__list--empty">Chưa Có Sản Phẩm</p>';
        } else {
            $str .= count($cart);
            $str .= 'OK';
            $str .= '<p class="cart__list-header">Sản Phẩm Mới Thêm</p>
            <ul class="cart__list-list">';
            foreach ($cart as $item) {
                $str .=  '<li class="cart__list-item">
                        <a href="#" class="cart__list-item-link">
                            <img class="cart__list-item-img" src="' . asset('img/uploads/' . $item['image_main']) . '" alt="">

                            <div class="cart__list-item-description">
                                <div class="cart__list-item-heading">
                                    <h4 class="cart__list-item-name">' . $item['name'] . '</h4>

                                    <div class="cart__list-item-detail">
                                        <span class="cart__list-item-cost highlight">' . $item['price'] . '</span>
                                        <span class="cart__list-item-multiply">x</span>
                                        <span class="cart__list-item-quanlity">' . $item['quantity'] . '</span>

                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>';
            }
            $str .= '</ul>';
            $str .= '<div class="cart__list-footer">
                <a href="./gio-hang" class="btn">Xem Giỏ Hàng</a>
            </div>';
        };

        return response()->json(array(
            'str' => $str,
        ));
    }
}
