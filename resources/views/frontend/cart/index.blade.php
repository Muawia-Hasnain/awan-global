@extends('frontend.layouts.app')

@section('title', 'Your Cart - Awan Global Foods')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-2">🛒 Your Shopping Cart</h1>
            @if(isset($cartItems) && count($cartItems) > 0)
                <p class="text-lg text-gray-600">You have {{ $cartCount }} {{ Str::plural('item', $cartCount) }} in your cart.</p>
            @endif
        </div>

        @if(isset($cartItems) && count($cartItems) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                <!-- Cart Items Section -->
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                    <div id="cart-items" class="divide-y divide-gray-200">
                        @foreach($cartItems as $id => $item)
                            <div class="py-6 flex flex-col md:flex-row items-center gap-6" data-item-id="{{ $id }}">
                                <img src="{{ $item['product_image'] }}" alt="{{ $item['product_name'] }}" class="w-24 h-24 rounded-lg object-cover">
                                <div class="flex-1 text-center md:text-left">
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $item['product_name'] }}</h3>
                                    <p class="text-green-600 font-medium mt-1">₹{{ number_format($item['price']) }} each</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button onclick="updateQuantity({{ $id }}, -1)" {{ $item['quantity'] <= 1 ? 'disabled' : '' }} class="w-8 h-8 rounded-full border border-gray-300 text-gray-600 hover:bg-gray-100 disabled:opacity-50">-</button>
                                    <input type="number" value="{{ $item['quantity'] }}" min="1" max="{{ $item['stock'] }}" onchange="updateQuantity({{ $id }}, this.value, true)" class="w-16 h-10 text-center border-gray-300 rounded-lg shadow-sm">
                                    <button onclick="updateQuantity({{ $id }}, 1)" {{ $item['quantity'] >= $item['stock'] ? 'disabled' : '' }} class="w-8 h-8 rounded-full border border-gray-300 text-gray-600 hover:bg-gray-100 disabled:opacity-50">+</button>
                                </div>
                                <p class="text-lg font-bold text-gray-900 w-24 text-center">₹{{ number_format($item['price'] * $item['quantity']) }}</p>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Remove item" class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-100">🗑️</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('products.index') }}" class="mt-6 inline-flex items-center gap-2 text-green-600 font-semibold hover:text-green-700">
                        ← Continue Shopping
                    </a>
                </div>

                <!-- Cart Summary -->
                <div class="lg:sticky top-8 bg-white rounded-xl shadow-sm p-6 border border-gray-200 space-y-4">
                    <h2 class="text-2xl font-bold text-gray-800 text-center mb-4">Order Summary</h2>
                    <div class="flex justify-between text-gray-600"><span>Subtotal</span> <span class="font-medium">₹{{ number_format($cartTotal) }}</span></div>
                    <div class="flex justify-between text-gray-600"><span>Delivery Fee</span> <span class="font-medium">@if($deliveryFee == 0) FREE @else ₹{{ number_format($deliveryFee) }} @endif</span></div>
                    @if($cartTotal < 1000)
                        <div class="bg-yellow-100 text-yellow-800 text-sm p-3 rounded-lg text-center">Add ₹{{ number_format(1000 - $cartTotal) }} more for FREE delivery!</div>
                    @endif
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex justify-between text-gray-900 font-bold text-lg"><span>Total</span> <span>₹{{ number_format($grandTotal) }}</span></div>
                    </div>
                    <a id="proceed-checkout" href="{{ route('checkout.index') }}" class="block w-full text-center py-3 px-6 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition-all text-lg">
                        🚀 Proceed to Checkout
                    </a>
                </div>
            </div>
        @else
            <!-- Empty Cart State -->
            <div class="text-center py-16 bg-white rounded-xl shadow-sm border border-gray-200">
                <p class="text-6xl mb-4">🛒</p>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Your cart is empty</h2>
                <p class="text-gray-600 mb-6">Looks like you haven't added any items yet.</p>
                <a href="{{ route('products.index') }}" class="py-3 px-6 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition-all">
                    🛍️ Start Shopping
                </a>
            </div>
        @endif
    </div>
</div>
@endsection