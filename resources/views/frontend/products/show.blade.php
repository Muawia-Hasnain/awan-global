@extends('frontend.layouts.app')

@section('title', $product->name . ' - Awan Global Foods')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-screen-xl mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8">
            <a href="{{ route('home') ?? '/' }}" class="text-green-600 hover:underline">Home</a>
            <span>/</span>
            <a href="{{ route('products.index') ?? '/products' }}" class="text-green-600 hover:underline">Shop</a>
            <span>/</span>
            <a href="/products?category={{ $product->category->slug }}" class="text-green-600 hover:underline">{{ $product->category->name }}</a>
            <span>/</span>
            <span class="font-medium text-gray-700">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            <!-- Product Image Gallery -->
            <div x-data="{ mainImage: '{{ $product->featured_image ? asset('storage/' . $product->featured_image) : 'https://via.placeholder.com/600x600' }}' }">
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 mb-4">
                    <img :src="mainImage" alt="Main product image" class="w-full h-auto max-h-[500px] object-contain rounded-lg">
                </div>
                <div class="grid grid-cols-4 gap-4">
                    @if(!empty($product->images))
                        @foreach(json_decode($product->images) as $image)
                            <div @click="mainImage = '{{ asset('storage/' . $image) }}'" class="cursor-pointer bg-white rounded-lg border-2 p-1" :class="{ 'border-green-500': mainImage === '{{ asset('storage/' . $image) }}' }">
                                <img src="{{ asset('storage/' . $image) }}" alt="Product thumbnail" class="w-full h-24 object-cover rounded-md">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Product Details -->
            <div class="space-y-6">
                <h1 class="text-4xl font-extrabold text-gray-900">{{ $product->name }}</h1>

                <div class="flex items-center gap-4">
                    <div class="flex items-center text-yellow-400">
                        @for($i = 1; $i <= 5; $i++) @if($i <= floor($product->rating ?? 0)) ⭐ @else ☆ @endif @endfor
                    </div>
                    <a href="#reviews" class="text-sm text-gray-500 hover:text-green-600">({{ $product->reviews_count ?? 0 }} customer reviews)</a>
                </div>

                <p class="text-gray-600 text-lg">{{ $product->short_description }}</p>

                <div class="flex items-baseline gap-4">
                    <span class="text-4xl font-bold text-green-600">₹{{ number_format($product->retail_price) }}</span>
                    @if($product->wholesale_price)
                        <span class="text-2xl text-gray-400 line-through">₹{{ number_format($product->wholesale_price) }}</span>
                    @endif
                </div>

                @if($product->stock_status === 'in_stock')
                    <span class="inline-flex items-center gap-2 text-green-700 font-semibold">
                        <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                        In Stock ({{ $product->stock_quantity }} units available)
                    </span>
                @else
                    <span class="inline-flex items-center gap-2 text-red-700 font-semibold">
                        <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                        Out of Stock
                    </span>
                @endif

                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="bg-gray-100 p-4 rounded-lg border border-gray-200">
                        <div class="flex items-center gap-6">
                            <div x-data="{ quantity: 1 }" class="flex items-center gap-2">
                                <button type="button" @click="quantity = Math.max(1, quantity - 1)" class="w-10 h-10 rounded-full bg-white border border-gray-300 text-lg font-bold hover:bg-gray-100">-</button>
                                <input x-model="quantity" name="quantity" type="text" class="w-16 h-10 text-center border-gray-300 rounded-lg shadow-sm">
                                <button type="button" @click="quantity++" class="w-10 h-10 rounded-full bg-white border border-gray-300 text-lg font-bold hover:bg-gray-100">+</button>
                            </div>
                            <button type="submit" class="flex-1 py-3 px-6 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition-all text-lg" {{ $product->stock_status !== 'in_stock' ? 'disabled' : '' }}>
                                🛒 Add to Cart
                            </button>
                        </div>
                    </div>
                </form>

                <div class="flex items-center gap-4">
                    <button class="flex items-center gap-2 text-gray-600 hover:text-red-500">
                        ❤️ Add to Wishlist
                    </button>
                    <span class="text-gray-300">|</span>
                    <span class="text-sm text-gray-500">SKU: {{ $product->sku }}</span>
                </div>
            </div>
        </div>

        <!-- Description & Reviews Section -->
        <div class="mt-16 bg-white rounded-xl shadow-lg border border-gray-200 p-8">
            <div x-data="{ tab: 'description' }">
                <div class="border-b border-gray-200 mb-6">
                    <nav class="flex gap-6">
                        <button @click="tab = 'description'" :class="{ 'border-green-500 text-green-600': tab === 'description', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'description' }" class="py-4 px-1 border-b-2 font-medium text-sm">
                            Full Description
                        </button>
                        <button @click="tab = 'reviews'" :class="{ 'border-green-500 text-green-600': tab === 'reviews', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'reviews' }" class="py-4 px-1 border-b-2 font-medium text-sm">
                            Reviews ({{ $product->reviews_count ?? 0 }})
                        </button>
                    </nav>
                </div>

                <div x-show="tab === 'description'" class="prose max-w-none">
                    {!! $product->description !!}
                </div>
                <div x-show="tab === 'reviews'" id="reviews" class="space-y-6">
                    @if($product->reviews && count($product->reviews) > 0)
                        @foreach($product->reviews as $review)
                            <div class="border-b border-gray-100 pb-6">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-600">{{ substr($review->user->name, 0, 1) }}</span>
                                    <span class="font-semibold text-gray-800">{{ $review->user->name }}</span>
                                    <div class="flex items-center text-yellow-400 text-lg">
                                        @for($i = 1; $i <= 5; $i++) @if($i <= $review->rating) ⭐ @else ☆ @endif @endfor
                                    </div>
                                </div>
                                <p class="text-gray-600">{{ $review->comment }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500">No reviews yet. Be the first to review this product!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
