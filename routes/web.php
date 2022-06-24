<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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
Route::get('/tim-kiem', [ProductController::class, 'search'])->name('products.search');
Route::get('/cua-hang', [ProductController::class, 'index'])->name('products');
// Route::get('/{category_url}', [ProductController::class, 'index'])
//     ->name('products.filter');
Route::get('/{slug}-{category_id}', [ProductController::class, 'index'])
    ->where('slug', '[a-zA-Z0-9-_]+')
    ->where('id', '[0-9]+')
    ->name('products.filter');

// Route::get('/cua-hang/{product_url}', [ProductController::class, 'show'])
//     ->name('products.show');
Route::get('/cua-hang/{slug}-{product_id}', [ProductController::class, 'show'])
    ->where('slug', '[a-zA-Z0-9-_]+')
    ->where('id', '[0-9]+')
    ->name('products.show');

Route::get('/user/login', [LoginController::class, 'login'])->name('user.login');
Route::post('/user/login', [LoginController::class, 'auth'])->name('user.auth');

Route::middleware('auth')->group(function () {
    Route::get('/user', [HomeController::class, 'index']);
    Route::get('/user/profile', [UserController::class, 'index'])->name('user.profile');
});
