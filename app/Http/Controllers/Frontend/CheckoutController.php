<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function index() { return view('frontend.checkout.index'); }
    public function shipping() { return view('frontend.checkout.shipping'); }
    public function payment() { return view('frontend.checkout.payment'); }
    public function review() { return view('frontend.checkout.review'); }
    public function success() { return view('frontend.checkout.success'); }
}
