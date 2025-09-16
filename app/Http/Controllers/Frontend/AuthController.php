<?php

namespace App\Http\Controllers\Frontend\Customer;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login() { return view('frontend.customer.auth.login'); }
    public function register() { return view('frontend.customer.auth.register'); }
    public function forgotPassword() { return view('frontend.customer.auth.forgot-password'); }
    public function resetPassword() { return view('frontend.customer.auth.reset-password'); }
}
