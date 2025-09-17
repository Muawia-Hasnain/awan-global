<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to view your wishlist.');
        }

        $wishlistItems = Wishlist::where('user_id', Auth::id())->with('product.category')->get();

        return view('frontend.account.wishlist', compact('wishlistItems'));
    }

    public function add(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to add items to your wishlist.');
        }

        $request->validate(['product_id' => 'required|exists:products,id']);

        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id
        ]);

        return redirect()->back()->with('success', 'Product added to your wishlist!');
    }

    public function remove($id)
    {
        Wishlist::where('id', $id)->where('user_id', Auth::id())->delete();

        return redirect()->back()->with('success', 'Product removed from your wishlist.');
    }
}
