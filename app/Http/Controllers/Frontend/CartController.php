<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index() { return view('frontend.cart.index'); }
    public function add() { return view('frontend.cart.add-to-cart'); }
    public function miniCart() { return view('frontend.cart.mini-cart'); }
    public function update() { return response()->json(['status' => 'ok']); }
    public function remove($id) { return response()->json(['status' => 'ok']); }
    public function clear() { return response()->json(['status' => 'ok']); }
    public function count() { return response()->json(['count' => 0]); }
}
