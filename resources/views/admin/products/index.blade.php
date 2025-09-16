@extends('layouts.admin')

@section('page-title', 'Products')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-gray-800">Product Management</h1>
    <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        + Add New Product
    </a>
</div>

<div class="overflow-x-auto bg-white rounded-lg shadow-md">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Category</th>
                <th scope="col" class="px-6 py-3">Retail Price</th>
                <th scope="col" class="px-6 py-3">Wholesale Price</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr class="bg-white border-b hover:bg-gray-50">
                <td class="px-6 py-4 font-bold text-gray-900">{{ $product->id }}</td>
                <td class="px-6 py-4">{{ $product->name }}</td>
                <td class="px-6 py-4">{{ $product->category->name ?? 'N/A' }}</td>
                <td class="px-6 py-4">{{ $product->retail_price }}</td>
                <td class="px-6 py-4">{{ $product->wholesale_price ?? 'N/A' }}</td>
                <td class="px-6 py-4">
                    @if($product->status)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Active
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            Inactive
                        </span>
                    @endif
                </td>
                <td class="px-6 py-4 text-center">
                    <div class="flex items-center justify-center space-x-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="px-3 py-1 bg-blue-500 text-white text-xs font-medium rounded-md hover:bg-blue-600">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-500 text-white text-xs font-medium rounded-md hover:bg-red-600">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                    No products found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{-- Assuming you will add pagination later --}}
    {{-- {{ $products->links() }} --}}
</div>
@endsection
