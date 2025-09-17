<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(12);
        $categories = Category::withCount('products')->get();

        return view('frontend.products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->with('category')->firstOrFail();
        return view('frontend.products.show', compact('product'));
    }

    public function category($id) { return view('frontend.products.category', compact('id')); }
    public function search() { return view('frontend.products.index'); }
    public function compare() { return view('frontend.products.index'); }
    public function recentlyViewed() { return response()->json([]); }
    public function relatedProducts($id) { return response()->json([]); }
    public function submitReview() { return response()->json(['status' => 'ok']); }
}
