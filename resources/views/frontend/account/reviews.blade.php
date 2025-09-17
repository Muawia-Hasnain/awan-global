@extends('frontend.layouts.app')

@section('title', 'My Reviews - Awan Global Foods')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-2">⭐ My Reviews</h1>
            <p class="text-lg text-gray-600">Here are the reviews you've shared.</p>
        </div>

        @if(isset($reviews) && count($reviews) > 0)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-6">
                @foreach($reviews as $review)
                    <div class="flex flex-col md:flex-row gap-6 border-b border-gray-200 pb-6 last:border-b-0 last:pb-0">
                        <a href="{{ route('products.show', $review->product->slug) }}" class="md:w-1/4">
                            <img src="{{ $review->product->featured_image ? asset('storage/' . $review->product->featured_image) : 'https://via.placeholder.com/100x100' }}" alt="{{ $review->product->name }}" class="w-full h-auto rounded-lg object-cover">
                        </a>
                        <div class="flex-1">
                            <div class="flex justify-between items-start">
                                <div>
                                    <a href="{{ route('products.show', $review->product->slug) }}" class="text-lg font-semibold text-gray-800 hover:text-green-600">{{ $review->product->name }}</a>
                                    <p class="text-sm text-gray-500">Reviewed on: {{ $review->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="flex items-center text-yellow-400 text-lg">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating) ⭐ @else ☆ @endif
                                    @endfor
                                </div>
                            </div>
                            <p class="mt-4 text-gray-600 leading-relaxed">{{ $review->comment }}</p>
                            <div class="mt-4 flex gap-2">
                                <!-- Add links to edit/delete review routes when they exist -->
                                <a href="#" class="text-sm text-green-600 font-semibold hover:underline">Edit Review</a>
                                <span class="text-gray-300">|</span>
                                <form action="#" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-500 font-semibold hover:underline">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 bg-white rounded-xl shadow-sm border border-gray-200">
                <p class="text-6xl mb-4">📝</p>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">You haven't written any reviews yet</h2>
                <p class="text-gray-600 mb-6">Share your thoughts on products you've purchased.</p>
                <a href="{{ route('products.index') }}" class="py-3 px-6 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition-all">
                    🛍️ Browse Products
                </a>
            </div>
        @endif
    </div>
</div>
@endsection