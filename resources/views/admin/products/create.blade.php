@extends('layouts.admin')

@section('page-title', 'Add New Product')

@section('content')
<h1 class="text-2xl font-semibold text-gray-800 mb-6">Add New Product</h1>

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Product Information</h2>
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="6" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                    </div>
                    <div>
                        <label for="short_description" class="block text-sm font-medium text-gray-700">Short Description</label>
                        <input type="text" name="short_description" id="short_description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Pricing & Stock</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="retail_price" class="block text-sm font-medium text-gray-700">Retail Price</label>
                        <input type="number" name="retail_price" id="retail_price" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="wholesale_price" class="block text-sm font-medium text-gray-700">Wholesale Price</label>
                        <input type="number" name="wholesale_price" id="wholesale_price" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="wholesale_min_qty" class="block text-sm font-medium text-gray-700">Wholesale Minimum Qty</label>
                        <input type="number" name="wholesale_min_qty" id="wholesale_min_qty" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="10">
                    </div>
                     <div>
                        <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
                        <input type="text" name="sku" id="sku" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label for="stock_quantity" class="block text-sm font-medium text-gray-700">Stock Quantity</label>
                        <input type="number" name="stock_quantity" id="stock_quantity" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="0">
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
                            {{-- Assuming $categories is passed from the controller --}}
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="product_type" class="block text-sm font-medium text-gray-700">Product Type</label>
                        <select name="product_type" id="product_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="retail">Retail</option>
                            <option value="wholesale">Wholesale</option>
                            <option value="both" selected>Both</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <div class="mt-2 space-y-2">
                            <div class="flex items-center">
                                <input id="status_active" name="status" type="radio" value="1" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" checked>
                                <label for="status_active" class="ml-3 block text-sm font-medium text-gray-700">Active</label>
                            </div>
                            <div class="flex items-center">
                                <input id="status_inactive" name="status" type="radio" value="0" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                <label for="status_inactive" class="ml-3 block text-sm font-medium text-gray-700">Inactive</label>
                            </div>
                        </div>
                    </div>
                     <div>
                        <label class="block text-sm font-medium text-gray-700">Featured</label>
                         <div class="flex items-center mt-2">
                            <input id="is_featured" name="is_featured" type="checkbox" value="1" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="is_featured" class="ml-2 block text-sm text-gray-900">Mark as featured product</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Featured Image</h2>
                <input type="file" name="featured_image" id="featured_image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            </div>
            <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Save Product
            </button>
        </div>
    </div>
</form>
@endsection
