<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index() { return view('frontend.account.orders.index'); }
    public function show($id) { return view('frontend.account.orders.show', compact('id')); }
    public function track($id) { return view('frontend.account.orders.track', compact('id')); }
}
