@extends('layouts.admin')

@section('page-title', 'Categories Management')

@section('content')
<div x-data="{
    deleteModalOpen: false,
    deleteTargetId: null,
    deleteTargetName: '',
    deleteTargetType: '',
    addCategoryModalOpen: false,
    addSubCategoryModalOpen: false
}">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Categories & Subcategories</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700">
                + Add Category
            </a>
        </div>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Type</th>
                    <th scope="col" class="px-6 py-3">Parent</th>
                    <th scope="col" class="px-6 py-3 text-center">Products</th>
                    <th scope="col" class="px-6 py-3 text-center">Status</th>
                    <th scope="col" class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr class="bg-white border-t">
                    <td class="px-6 py-4 font-bold text-gray-900">
                        <div class="flex items-center">
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-10 h-10 rounded-md object-cover mr-4">
                            @else
                                <div class="w-10 h-10 rounded-md bg-gray-200 mr-4 flex items-center justify-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14" /></svg>
                                </div>
                            @endif
                            <span>{{ $category->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">Main Category</span></td>
                    <td class="px-6 py-4">-</td>
                    <td class="px-6 py-4 text-center">{{ $category->products_count }}</td>
                    <td class="px-6 py-4 text-center">
                         <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $category->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $category->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="px-3 py-1 bg-blue-500 text-white text-xs font-medium rounded-md hover:bg-blue-600">Edit</a>
                            <button @click="deleteTargetId = {{ $category->id }}; deleteTargetName = '{{ $category->name }}'; deleteTargetType = 'category'; deleteModalOpen = true" class="px-3 py-1 bg-red-500 text-white text-xs font-medium rounded-md hover:bg-red-600">Delete</button>
                        </div>
                    </td>
                </tr>
                    @foreach($category->subcategories as $subCategory)
                    <tr class="bg-gray-50 border-t">
                        <td class="pl-12 pr-6 py-3 text-gray-800">
                            <div class="flex items-center">
                                <span class="mr-2 text-gray-400">&#9492;</span>
                                @if($subCategory->image)
                                     <img src="{{ asset('storage/' . $subCategory->image) }}" alt="{{ $subCategory->name }}" class="w-8 h-8 rounded-md object-cover mr-3">
                                @endif
                                <span>{{ $subCategory->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-3"><span class="px-2 py-1 text-xs font-semibold text-gray-800 bg-gray-200 rounded-full">Subcategory</span></td>
                        <td class="px-6 py-3 text-sm text-gray-600">{{ $category->name }}</td>
                        <td class="px-6 py-3 text-center">{{ $subCategory->products_count }}</td>
                        <td class="px-6 py-3 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $subCategory->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $subCategory->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                             <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.subcategories.edit', $subCategory->id) }}" class="px-3 py-1 bg-blue-500 text-white text-xs font-medium rounded-md hover:bg-blue-600">Edit</a>
                                <button @click="deleteTargetId = {{ $subCategory->id }}; deleteTargetName = '{{ $subCategory->name }}'; deleteTargetType = 'subcategory'; deleteModalOpen = true" class="px-3 py-1 bg-red-500 text-white text-xs font-medium rounded-md hover:bg-red-600">Delete</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                        No categories found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>

    <!-- Delete Modal -->
    <div x-show="deleteModalOpen" @keydown.escape.window="deleteModalOpen = false" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="deleteModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="deleteModalOpen = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="deleteModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Delete <span x-text="deleteTargetType"></span>
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to delete "<strong x-text="deleteTargetName"></strong>"? This action cannot be undone.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form :action="deleteTargetType === 'category' ? `/admin/categories/${deleteTargetId}` : `/admin/subcategories/${deleteTargetId}`" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Delete
                        </button>
                    </form>
                    <button @click="deleteModalOpen = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection