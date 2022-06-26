<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function ajax(Request $request) {
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

        if (Session::has('cart')) {
            $cart = Session::get('cart');

            for ($i = 0; $i < count($cart); $i++) {
                if ($cart[$i]['id'] == $id) {
                    $cart[$i]['quantity'] += $quantity;

                    Session::put('cart', $cart);
                    $isExisting = true;
                    break;
                }
            }

            if ($isExisting == false) {
                $product['quantity'] = $quantity;
                Session::push('cart', $product);
            }
        } else {
            $product['quantity'] = $quantity;
            Session::push('cart', $product);
        }

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
                                <h4 class="cart__list-item-name">'.$item['name'].'</h4>
                                
                                <div class="cart__list-item-detail">
                                    <span class="cart__list-item-cost highlight">'.$item['price'].'</span>
                                    <span class="cart__list-item-multiply">x</span>
                                    <span class="cart__list-item-quanlity">'.$item['quantity'].'</span>
                                    
                                </div>
                            </div>
                        </div>
                    </a>
                </li>';
        }
        $str .= '</ul>';
        $str .= '<div class="cart__list-footer">
            <a href="' . route('cart') .'" class="btn">Xem Giỏ Hàng</a>
        </div>';

        return response()->json(array(
            'success' => true,
            'str' => $str,
        ));
    }

    public function update($id, $quantity)
    {
        $cart = Session::get('cart');
        for($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['id'] == $id) {
                echo 'OK';
                $cart[$i]['quantity'] = $quantity;
                Session::put('cart', $cart);
                break;
            }
        }
    }

    public function deleteFromCart($id)
    {
        $cart = Session::get('cart');
        for($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['id'] == $id) {
                Session::forget('cart')[$i];
                Session::save();
                break;
            }
        }

        // $_SESSION['cart'] = array_values($_SESSION['cart']);
        // if (count($_SESSION['cart']) == 0) {
        //     echo '';
        //     echo 'OK';
        //     echo '<img class="no-cart" src="./assets/img/no_cart.png" alt="">
        //     <p class="cart__list--empty">Chưa Có Sản Phẩm</p>';
        // } else {
        //     echo count($_SESSION['cart']);
        //     echo 'OK';
        //     echo '<p class="cart__list-header">Sản Phẩm Mới Thêm</p>
        //     <ul class="cart__list-list">';
        //     foreach ($_SESSION['cart'] as $each) {
        //         echo  '<li class="cart__list-item">
        //                 <a href="#" class="cart__list-item-link">
        //                     <img class="cart__list-item-img" src="./assets/img/uploads/'. $each['image'] .'" alt="">
                            
        //                     <div class="cart__list-item-description">
        //                         <div class="cart__list-item-heading">
        //                             <h4 class="cart__list-item-name">'.$each['name'].'</h4>
                                    
        //                             <div class="cart__list-item-detail">
        //                                 <span class="cart__list-item-cost highlight">'.$each['new_price'].'</span>
        //                                 <span class="cart__list-item-multiply">x</span>
        //                                 <span class="cart__list-item-quanlity">'.$each['quantity'].'</span>
                                        
        //                             </div>
        //                         </div>
        //                     </div>
        //                 </a>
        //             </li>';
        //     }
        //     echo '</ul>';
        //     echo '<div class="cart__list-footer">
        //         <a href="./gio-hang" class="btn">Xem Giỏ Hàng</a>
        //     </div>';
        // };
    }
}
