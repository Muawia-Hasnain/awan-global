<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function index() { return view('frontend.account.addresses.index'); }
    public function create() { return view('frontend.account.addresses.create'); }
    public function edit($id) { return view('frontend.account.addresses.edit', compact('id')); }
}
