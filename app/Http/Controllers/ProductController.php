<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\UrlService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategory = Category::whereId($request->category_id)->first();
        $products = $selectedCategory ? Product::getByCategory($selectedCategory) : Product::paginate(2);
        $categories = Category::getTotalPerCategory();
        $totalProducts = Product::count();

        return view('pages.products', data: [
            'products' => $products,
            'categories' => $categories,
            'total_products' => $totalProducts,
            'selectedCategory' => $selectedCategory,
        ]);
    }

    public function show(Request $request)
    {
        $product = Product::find($request->product_id);
        return view('pages.product-detail', data: [
            'product' => $product,
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->q;
        $products = Product::where('name', 'LIKE', '%' . $search . '%')->get();

        return view('pages.products-search', data: [
            'products' => $products,
            'search' => $search,
        ]);
    }
}
