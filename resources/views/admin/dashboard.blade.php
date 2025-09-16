@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<div x-data="{ quickAddModalOpen: false }">

    <!-- Stats Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 text-white rounded-lg shadow-lg p-6 flex items-center justify-between">
            <div>
                <div class="text-3xl font-bold">{{ $stats['total_products'] }}</div>
                <div class="text-blue-200">Total Products</div>
            </div>
            <div class="bg-blue-400 rounded-full p-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
            </div>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-teal-600 text-white rounded-lg shadow-lg p-6 flex items-center justify-between">
            <div>
                <div class="text-3xl font-bold">{{ $stats['total_categories'] }}</div>
                <div class="text-green-200">Categories</div>
            </div>
            <div class="bg-green-400 rounded-full p-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 8v5c0 1.1.9 2 2 2h5" /></svg>
            </div>
        </div>
        <div class="bg-gradient-to-br from-yellow-500 to-orange-600 text-white rounded-lg shadow-lg p-6 flex items-center justify-between">
            <div>
                <div class="text-3xl font-bold">{{ $stats['total_orders'] ?? 0 }}</div>
                <div class="text-yellow-200">Total Orders</div>
            </div>
             <div class="bg-yellow-400 rounded-full p-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4z" /></svg>
            </div>
        </div>
        <div class="bg-gradient-to-br from-pink-500 to-purple-600 text-white rounded-lg shadow-lg p-6 flex items-center justify-between">
            <div>
                <div class="text-3xl font-bold">{{ $stats['total_customers'] ?? 0 }}</div>
                <div class="text-pink-200">Customers</div>
            </div>
            <div class="bg-pink-400 rounded-full p-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
            </div>
        </div>
    </div>
    <!-- End Stats Section -->

    <!-- Main Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Products -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-md">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">Recent Products</h3>
                <button @click="quickAddModalOpen = true" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Add Product
                </button>
            </div>
            <div class="p-4">
                @if($recent_products->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Product</th>
                                    <th scope="col" class="px-6 py-3">Category</th>
                                    <th scope="col" class="px-6 py-3">Type</th>
                                    <th scope="col" class="px-6 py-3">Price</th>
                                    <th scope="col" class="px-6 py-3">Stock</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_products as $product)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap flex items-center">
                                        <img src="{{ $product->first_image }}" alt="{{ $product->name }}" class="w-10 h-10 rounded-full object-cover mr-3">
                                        <div>
                                            <div>{{ $product->name }}</div>
                                            <div class="text-xs text-gray-400">SKU: {{ $product->sku }}</div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4">
                                        <span class="text-xs font-medium px-2 py-1 rounded-full bg-gray-100 text-gray-800">{{ $product->category->name }}</span>
                                        @if($product->subcategory)
                                            <span class="text-xs font-medium px-2 py-1 rounded-full bg-gray-100 text-gray-600 mt-1 block">{{ $product->subcategory->name }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-xs font-medium px-2 py-1 rounded-full {{ $product->product_type == 'both' ? 'bg-blue-100 text-blue-800' : ($product->product_type == 'retail' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800') }}">
                                            {{ ucfirst($product->product_type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">
                                        @if($product->retail_price) <div>R: {{ $product->formatted_retail_price }}</div> @endif
                                        @if($product->wholesale_price) <div class="text-xs">W: {{ $product->formatted_wholesale_price }}</div> @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($product->stock_quantity > 10)
                                            <span class="text-green-500 font-semibold">{{ $product->stock_quantity }}</span>
                                        @elseif($product->stock_quantity > 0)
                                             <span class="text-yellow-500 font-semibold">{{ $product->stock_quantity }}</span>
                                        @else
                                            <span class="text-red-500 font-semibold">Out of Stock</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($product->status)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="font-medium text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No products yet</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new product.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                               <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                                New Product
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions & System Info -->
        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Quick Actions</h3>
                </div>
                <div class="p-4 space-y-3">
                    <button @click="quickAddModalOpen = true" class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Add New Product
                    </button>
                    <a href="{{ route('admin.categories.create') }}" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Add Category
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        View Orders
                    </a>
                </div>
            </div>
             <div class="bg-white rounded-lg shadow-md">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">System Info</h3>
                </div>
                <div class="p-4 text-sm text-gray-600 space-y-2">
                   <div class="flex justify-between"><span>Laravel Version:</span> <span class="font-medium">{{ app()->version() }}</span></div>
                   <div class="flex justify-between"><span>PHP Version:</span> <span class="font-medium">{{ PHP_VERSION }}</span></div>
                   <div class="flex justify-between"><span>Last Update:</span> <span class="font-medium">{{ now()->format('M d, Y') }}</span></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Add Product Modal -->
    <div x-show="quickAddModalOpen" @keydown.escape.window="quickAddModalOpen = false" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div x-show="quickAddModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="quickAddModalOpen = false" aria-hidden="true"></div>

            <!-- Modal panel -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="quickAddModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" id="quickAddForm">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Quick Add Product</h3>
                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="sm:col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Product Name *</label>
                                <input type="text" name="name" id="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            </div>
                            <div>
                                <label for="categorySelect" class="block text-sm font-medium text-gray-700">Category *</label>
                                <select name="category_id" id="categorySelect" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <option value="" selected disabled>Choose Category...</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="subcategorySelect" class="block text-sm font-medium text-gray-700">Subcategory</label>
                                <select name="subcategory_id" id="subcategorySelect" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">No Subcategory</option>
                                </select>
                            </div>
                            <div>
                                <label for="product_type" class="block text-sm font-medium text-gray-700">Product Type *</label>
                                <select name="product_type" id="product_type" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <option value="retail" selected>Retail Only</option>
                                    <option value="wholesale">Wholesale Only</option>
                                    <option value="both">Both Retail & Wholesale</option>
                                </select>
                            </div>
                            <div>
                                <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
                                <input type="text" name="sku" id="sku" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Auto-generated if empty">
                            </div>
                             <div>
                                <label for="retail_price" class="block text-sm font-medium text-gray-700">Retail Price *</label>
                                <input type="number" step="0.01" name="retail_price" id="retail_price" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="0" required>
                            </div>
                             <div>
                                <label for="stock_quantity" class="block text-sm font-medium text-gray-700">Stock Quantity *</label>
                                <input type="number" name="stock_quantity" id="stock_quantity" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="0" min="0" required>
                            </div>
                            <div id="wholesalePriceField" style="display: none;">
                                <label for="wholesale_price" class="block text-sm font-medium text-gray-700">Wholesale Price</label>
                                <input type="number" step="0.01" name="wholesale_price" id="wholesale_price" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="0">
                            </div>
                            <div id="wholesaleMinQtyField" style="display: none;">
                                <label for="wholesale_min_qty" class="block text-sm font-medium text-gray-700">Wholesale Min Qty</label>
                                <input type="number" name="wholesale_min_qty" id="wholesale_min_qty" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="10" min="1">
                            </div>
                            <div class="sm:col-span-2">
                                <label for="featured_image" class="block text-sm font-medium text-gray-700">Featured Image *</label>
                                <input type="file" name="featured_image" id="featured_image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" required>
                            </div>
                            <div class="sm:col-span-2">
                                <div class="flex items-center">
                                    <input id="statusSwitch" name="status" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                                    <label for="statusSwitch" class="ml-2 block text-sm text-gray-900">Product Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Save Product
                        </button>
                        <button type="button" @click="quickAddModalOpen = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('categorySelect');
    const subcategorySelect = document.getElementById('subcategorySelect');
    const productTypeSelect = document.getElementById('product_type');
    const wholesalePriceField = document.getElementById('wholesalePriceField');
    const wholesaleMinQtyField = document.getElementById('wholesaleMinQtyField');
    
    function toggleWholesaleFields() {
        if (productTypeSelect.value === 'wholesale' || productTypeSelect.value === 'both') {
            wholesalePriceField.style.display = 'block';
            wholesaleMinQtyField.style.display = 'block';
        } else {
            wholesalePriceField.style.display = 'none';
            wholesaleMinQtyField.style.display = 'none';
        }
    }

    if (productTypeSelect) {
        productTypeSelect.addEventListener('change', toggleWholesaleFields);
        toggleWholesaleFields(); // Initial check
    }
    
    if (categorySelect) {
        categorySelect.addEventListener('change', function() {
            const categoryId = this.value;
            subcategorySelect.innerHTML = '<option value="">Loading...</option>';

            if (categoryId) {
                fetch(`/admin/get-subcategories/${categoryId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        subcategorySelect.innerHTML = '<option value="">No Subcategory</option>';
                        if(data.subcategories && data.subcategories.length > 0) {
                            data.subcategories.forEach(sub => {
                                subcategorySelect.innerHTML += `<option value="${sub.id}">${sub.name}</option>`;
                            });
                        } else {
                             subcategorySelect.innerHTML = '<option value="">No subcategories found</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching subcategories:', error);
                        subcategorySelect.innerHTML = '<option value="">Error loading</option>';
                    });
            } else {
                subcategorySelect.innerHTML = '<option value="">No Subcategory</option>';
            }
        });
    }
    
    const quickAddForm = document.getElementById('quickAddForm');
    if (quickAddForm) {
        quickAddForm.addEventListener('submit', function(e) {
            // Basic validation, can be enhanced
            const name = document.getElementById('name').value;
            const categoryId = document.getElementById('categorySelect').value;
            const retailPrice = document.getElementById('retail_price').value;
            const featuredImage = document.getElementById('featured_image').files.length;

            if (!name || !categoryId || !retailPrice || featuredImage === 0) {
                e.preventDefault();
                alert('Please fill all required fields (Name, Category, Retail Price, Featured Image)');
            }
        });
    }
});
</script>
@endpush