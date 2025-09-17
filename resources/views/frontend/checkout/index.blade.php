@extends('frontend.layouts.app')

@section('title', 'Checkout - Awan Global Foods')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-2">🛒 Secure Checkout</h1>
            <p class="text-lg text-gray-600">Complete your order in a few simple steps.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            <!-- Checkout Form -->
            <form id="checkout-form" method="POST" action="{{ route('checkout.process') ?? '#' }}" class="lg:col-span-2 bg-white rounded-xl shadow-sm p-8 border border-gray-200 space-y-8">
                @csrf
                <!-- Delivery Address -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">📍 Delivery Address</h2>
                    <div class="space-y-4">
                        @forelse($savedAddresses as $address)
                            <label class="block bg-white p-4 rounded-lg border-2 {{ $address->is_default ? 'border-green-500' : 'border-gray-200' }} cursor-pointer has-[:checked]:border-green-500 has-[:checked]:bg-green-50">
                                <input type="radio" name="address_id" value="{{ $address->id }}" class="hidden" {{ $address->is_default ? 'checked' : '' }}>
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $address->title }}</p>
                                        <p class="text-sm text-gray-600 mt-1">{{ $address->name }}, {{ $address->address }}, {{ $address->city }}</p>
                                    </div>
                                    @if($address->is_default) <span class="text-xs bg-green-500 text-white px-2 py-1 rounded-full">Default</span> @endif
                                </div>
                            </label>
                        @empty
                             <p class="text-sm text-gray-500">You have no saved addresses. Please add one below.</p>
                        @endforelse
                    </div>
                    <!-- You can add a button here to toggle a 'new address' form -->
                </section>

                <!-- Payment Method -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">💳 Payment Method</h2>
                    <div class="space-y-4">
                        <label class="block bg-white p-4 rounded-lg border-2 border-green-500 cursor-pointer has-[:checked]:border-green-500 has-[:checked]:bg-green-50">
                            <input type="radio" name="payment_method" value="cod" class="hidden" checked>
                            <p class="font-semibold text-gray-800">Cash on Delivery</p>
                            <p class="text-sm text-gray-600">Pay when your order arrives.</p>
                        </label>
                    </div>
                </section>
            </form>

            <!-- Order Summary -->
            <div class="lg:sticky top-8 bg-white rounded-xl shadow-sm p-6 border border-gray-200 space-y-4">
                <h2 class="text-2xl font-bold text-gray-800 text-center mb-4">📋 Order Summary</h2>
                <div class="divide-y divide-gray-200">
                    @foreach($cartItems as $item)
                        <div class="py-4 flex items-center gap-4">
                            <img src="{{ $item['product_image'] }}" alt="{{ $item['product_name'] }}" class="w-16 h-16 rounded-lg object-cover">
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">{{ $item['product_name'] }}</p>
                                <p class="text-sm text-gray-500">Qty: {{ $item['quantity'] }}</p>
                            </div>
                            <p class="font-semibold text-gray-800">₹{{ number_format($item['price'] * $item['quantity']) }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="border-t border-gray-200 pt-4 space-y-2">
                    <div class="flex justify-between text-gray-600"><span>Subtotal</span> <span class="font-medium">₹{{ number_format($cartTotal) }}</span></div>
                    <div class="flex justify-between text-gray-600"><span>Delivery</span> <span class="font-medium">@if($deliveryFee == 0) FREE @else ₹{{ number_format($deliveryFee) }} @endif</span></div>
                    <div class="flex justify-between text-gray-900 font-bold text-lg pt-2 border-t"><span>Total</span> <span>₹{{ number_format($grandTotal) }}</span></div>
                </div>
                <button type="submit" form="checkout-form" class="w-full mt-4 py-3 px-6 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition-all text-lg">
                    🛒 Place Order
                </button>
            </div>
        </div>
    </div>
</div>
@endsection