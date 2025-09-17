<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        $cartTotal = collect($cartItems)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
        $cartCount = collect($cartItems)->sum('quantity');
        $deliveryFee = $cartTotal > 1000 ? 0 : 100;
        $grandTotal = $cartTotal + $deliveryFee;

        return view('frontend.cart.index', compact('cartItems', 'cartTotal', 'cartCount', 'deliveryFee', 'grandTotal'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            $cart[$product->id] = [
                "product_name" => $product->name,
                "quantity" => $request->quantity,
                "price" => $product->retail_price,
                "product_image" => $product->featured_image ? asset('storage/' . $product->featured_image) : 'https://via.placeholder.com/80x80',
                "stock" => $product->stock_quantity,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Product removed successfully');
    }

    // Other methods can be implemented as needed
    public function miniCart() { return view('frontend.cart.mini-cart'); }
    public function update() { return response()->json(['status' => 'ok']); }
    public function clear() { return response()->json(['status' => 'ok']); }
    public function count() { return response()->json(['count' => 0]); }
}
