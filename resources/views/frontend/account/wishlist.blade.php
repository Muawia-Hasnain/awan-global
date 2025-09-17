@extends('frontend.layouts.app')

@section('title', 'My Wishlist - Awan Global Foods')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-2">❤️ My Wishlist</h1>
            <p class="text-lg text-gray-600">Your collection of saved items for later.</p>
        </div>

        @if(isset($wishlistItems) && count($wishlistItems) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($wishlistItems as $item)
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden group transition-all hover:shadow-lg hover:-translate-y-1">
                        <div class="relative">
                            <a href="{{ route('products.show', $item->product->slug) }}" class="block">
                                <img src="{{ $item->product->featured_image ? asset('storage/' . $item->product->featured_image) : 'https://via.placeholder.com/300x300' }}" alt="{{ $item->product->name }}" class="w-full h-48 object-cover">
                            </a>
                            <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" class="absolute top-3 right-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-9 h-9 rounded-full bg-white shadow-md flex items-center justify-center text-red-500 hover:bg-red-100 hover:scale-110 transition-all" title="Remove from Wishlist">
                                    &times;
                                </button>
                            </form>
                        </div>
                        <div class="p-4 flex flex-col flex-grow">
                            <div class="flex-grow">
                                <p class="text-xs text-gray-500 mb-1">{{ $item->product->category->name ?? 'Uncategorized' }}</p>
                                <h3 class="text-base font-semibold text-gray-800 mb-2 h-12">{{ $item->product->name }}</h3>
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-xl font-bold text-green-600">₹{{ number_format($item->product->retail_price) }}</span>
                                </div>
                            </div>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" {{ $item->product->stock_status !== 'in_stock' ? 'disabled' : '' }} class="w-full py-2 px-4 rounded-lg text-sm font-semibold transition-all {{ $item->product->stock_status !== 'in_stock' ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'bg-green-600 text-white hover:bg-green-700' }}">
                                    {{ $item->product->stock_status !== 'in_stock' ? 'Out of Stock' : '🛒 Add to Cart' }}
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 bg-white rounded-xl shadow-sm border border-gray-200">
                <p class="text-6xl mb-4">💔</p>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Your wishlist is empty</h2>
                <p class="text-gray-600 mb-6">Start browsing to add items you love.</p>
                <a href="{{ route('products.index') }}" class="py-3 px-6 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition-all">
                    🛍️ Discover Products
                </a>
            </div>
        @endif
    </div>
</div>
@endsection