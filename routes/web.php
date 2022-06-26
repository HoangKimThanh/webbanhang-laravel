<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/trang-chu', [HomeController::class, 'index'])->name('home');
Route::get('/gioi-thieu', [HomeController::class, 'intro'])->name('intro');
Route::get('/tin-tuc', [HomeController::class, 'news'])->name('news');
Route::get('/lien-he', [HomeController::class, 'contact'])->name('contact');
Route::get('/dang-ky', [HomeController::class, 'register'])->name('register');
Route::get('/dang-nhap', [HomeController::class, 'login'])->name('login');
Route::get('/gio-hang', [HomeController::class, 'cart'])->name('cart');

Route::get('/cua-hang', [ProductController::class, 'index'])->name('products');
Route::get('/tim-kiem', [ProductController::class, 'search'])->name('products.search');

Route::post('/cart-ajax', [CartController::class, 'ajax'])->name('cart-ajax');

Route::post('/dang-ky', [UserController::class, 'register'])->name('user.register');
Route::post('/dang-nhap', [UserController::class, 'login'])->name('user.login');
Route::get('/dang-xuat', [UserController::class, 'logout'])->name('user.logout');

Route::middleware('auth:user')->group(function () {
    Route::get('/thong-tin-ca-nhan', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/thong-tin-ca-nhan', [UserController::class, 'update'])->name('user.update');
    Route::get('/lich-su-mua-hang', [UserController::class, 'index'])->name('user.profile');
});

Route::get('/{category_url}', [ProductController::class, 'index'])
    ->name('products.filter');
// Route::get('/{slug}-{category_id}', [ProductController::class, 'index'])
//     ->where('slug', '[a-zA-Z0-9-_]+')
//     ->where('id', '[0-9]+')
//     ->name('products.filter');

// Route::get('/cua-hang/{product_url}', [ProductController::class, 'show'])
//     ->name('products.show');
Route::get('/cua-hang/{slug}-{product_id}', [ProductController::class, 'show'])
    ->where('slug', '[a-zA-Z0-9-_]+')
    ->where('id', '[0-9]+')
    ->name('products.show');

