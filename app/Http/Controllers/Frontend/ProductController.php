<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index() { return view('frontend.products.index'); }
    public function show($id) { return view('frontend.products.show', compact('id')); }
    public function category($id) { return view('frontend.products.category', compact('id')); }
    public function search() { return view('frontend.products.index'); }
    public function compare() { return view('frontend.products.index'); }
    public function recentlyViewed() { return response()->json([]); }
    public function relatedProducts($id) { return response()->json([]); }
    public function submitReview() { return response()->json(['status' => 'ok']); }
}
