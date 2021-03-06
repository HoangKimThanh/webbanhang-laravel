<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Services\UrlService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort ?? 'asc';
        $selectedCategory = Category::whereId($request->category_id)->first();
        $products = $selectedCategory ? Product::getByCategory($selectedCategory, $sort) : Product::orderBy('old_price', $sort)->paginate(2);
        $products->appends(['sort' => $sort]);
        $categories = Category::getTotalPerCategory();
        $totalProducts = Product::count();

        return view('pages.products', data: [
            'products' => $products,
            'categories' => $categories,
            'total_products' => $totalProducts,
            'selectedCategory' => $selectedCategory,
            'sort' => $sort,
        ]);
    }

    public function show(Request $request)
    {
        $productId = $request->product_id;
        $product = Product::find($productId);
        $reviews = Review::whereStatus(1)
            ->whereProductId($productId)
            ->get();

        return view('pages.product-detail', data: [
            'product' => $product,
            'reviews' => $reviews
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
