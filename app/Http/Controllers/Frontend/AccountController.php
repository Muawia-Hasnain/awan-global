<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function dashboard() { return view('frontend.account.dashboard'); }
    public function profile() { return view('frontend.account.profile'); }
    public function wishlist() { return view('frontend.account.wishlist'); }
    public function reviews() { return view('frontend.account.reviews'); }
    public function changePassword() { return view('frontend.account.change-password'); }
}
