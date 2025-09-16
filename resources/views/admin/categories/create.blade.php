@extends('layouts.admin')

@section('page-title', 'Add New Category')

@section('content')
<h1 class="text-2xl font-semibold text-gray-800 mb-6">Add New Category</h1>

<form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <div class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Category Image</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                 @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <div class="mt-2">
                    <label class="inline-flex items-center">
                        <input type="radio" name="status" value="1" class="form-radio h-4 w-4 text-indigo-600" checked>
                        <span class="ml-2">Active</span>
                    </label>
                    <label class="inline-flex items-center ml-6">
                        <input type="radio" name="status" value="0" class="form-radio h-4 w-4 text-indigo-600">
                        <span class="ml-2">Inactive</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="mt-8 border-t pt-5">
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-300">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700">
                    Save Category
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
