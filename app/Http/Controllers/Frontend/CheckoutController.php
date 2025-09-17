<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $cartTotal = collect($cartItems)->sum(fn($item) => $item['price'] * $item['quantity']);
        $deliveryFee = $cartTotal > 1000 ? 0 : 100;
        $grandTotal = $cartTotal + $deliveryFee;

        // In a real app, you would fetch this from the database for the logged-in user
        $savedAddresses = [];
        if(Auth::check()){
            // $savedAddresses = Auth::user()->addresses;
        }

        return view('frontend.checkout.index', compact('cartItems', 'cartTotal', 'deliveryFee', 'grandTotal', 'savedAddresses'));
    }

    public function process(Request $request)
    {
        // This is where you would process the order:
        // 1. Validate the request data (address, payment method, etc.)
        // 2. Create a new Order in the database.
        // 3. Create OrderItems for each item in the cart.
        // 4. Clear the cart from the session.
        // 5. Redirect to a success page with the order details.

        // For now, we'll just clear the cart and redirect to a placeholder success page.
        session()->forget('cart');

        return redirect()->route('checkout.success')->with('success', 'Your order has been placed successfully!');
    }

    public function success()
    {
        // A simple success page view
        return view('frontend.checkout.success');
    }

    // Other methods can be kept as placeholders or implemented later
    public function shipping() { return view('frontend.checkout.shipping'); }
    public function payment() { return view('frontend.checkout.payment'); }
    public function review() { return view('frontend.checkout.review'); }
}
