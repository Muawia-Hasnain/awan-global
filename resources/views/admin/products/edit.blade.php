@extends('layouts.admin')

@section('page-title', 'Edit Product')

@section('content')
<h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Product: {{ $product->name }}</h1>

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Product Information</h2>
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="6" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('description', $product->description) }}</textarea>
                    </div>
                    <div>
                        <label for="short_description" class="block text-sm font-medium text-gray-700">Short Description</label>
                        <input type="text" name="short_description" id="short_description" value="{{ old('short_description', $product->short_description) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Pricing & Stock</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="retail_price" class="block text-sm font-medium text-gray-700">Retail Price</label>
                        <input type="number" name="retail_price" id="retail_price" value="{{ old('retail_price', $product->retail_price) }}" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="wholesale_price" class="block text-sm font-medium text-gray-700">Wholesale Price</label>
                        <input type="number" name="wholesale_price" id="wholesale_price" value="{{ old('wholesale_price', $product->wholesale_price) }}" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="wholesale_min_qty" class="block text-sm font-medium text-gray-700">Wholesale Minimum Qty</label>
                        <input type="number" name="wholesale_min_qty" id="wholesale_min_qty" value="{{ old('wholesale_min_qty', $product->wholesale_min_qty) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                     <div>
                        <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
                        <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label for="stock_quantity" class="block text-sm font-medium text-gray-700">Stock Quantity</label>
                        <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Organize</h2>
                <div class="space-y-4">
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="product_type" class="block text-sm font-medium text-gray-700">Product Type</label>
                        <select name="product_type" id="product_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="retail" @selected(old('product_type', $product->product_type) == 'retail')>Retail</option>
                            <option value="wholesale" @selected(old('product_type', $product->product_type) == 'wholesale')>Wholesale</option>
                            <option value="both" @selected(old('product_type', $product->product_type) == 'both')>Both</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <div class="mt-2 space-y-2">
                            <div class="flex items-center">
                                <input id="status_active" name="status" type="radio" value="1" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" @checked(old('status', $product->status) == 1)>
                                <label for="status_active" class="ml-3 block text-sm font-medium text-gray-700">Active</label>
                            </div>
                            <div class="flex items-center">
                                <input id="status_inactive" name="status" type="radio" value="0" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" @checked(old('status', $product->status) == 0)>
                                <label for="status_inactive" class="ml-3 block text-sm font-medium text-gray-700">Inactive</label>
                            </div>
                        </div>
                    </div>
                     <div>
                        <label class="block text-sm font-medium text-gray-700">Featured</label>
                         <div class="flex items-center mt-2">
                            <input id="is_featured" name="is_featured" type="checkbox" value="1" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" @checked(old('is_featured', $product->is_featured) == 1)>
                            <label for="is_featured" class="ml-2 block text-sm text-gray-900">Mark as featured product</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Featured Image</h2>
                @if($product->featured_image)
                    <img src="{{ asset('storage/' . $product->featured_image) }}" alt="{{ $product->name }}" class="mb-4 w-full h-auto rounded-lg">
                @endif
                <input type="file" name="featured_image" id="featured_image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                <small class="text-gray-500 mt-1">Leave blank to keep the current image.</small>
            </div>
            <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Update Product
            </button>
        </div>
    </div>
</form>
@endsection
