<?php
// app/Http/Controllers/Admin/AdminCategoryController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories with their subcategories
     */
    public function index()
    {
        $categories = Category::with('subcategories')
            ->orderBy('name', 'asc')
            ->paginate(20);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name'  => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status'=> 'nullable', // ✅ boolean ko nullable rakho
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('categories', 'public');
    }

    Category::create([
        'name'  => $validated['name'],
        'image' => $imagePath,
        'status'=> $request->has('status') ? 1 : 0, // ✅ default handle
    ]);

    return redirect()->route('admin.categories.index')
        ->with('success', 'Category created successfully!');
}


    /**
     * Display the specified category
     */
    public function show(Category $category)
    {
        $category->load('subcategories');
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean'
        ]);

        // Handle image upload
        $imagePath = $category->image;
        if ($request->hasFile('image')) {
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        // Update category
        $category->update([
            'name' => $validated['name'],
            'image' => $imagePath,
            'status' => $validated['status'] ?? 0
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category
     */
    public function destroy(Category $category)
    {
        // Delete image if exists
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        // Delete category (subcategories will be deleted automatically due to cascade)
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully!');
    }

    /**
     * Toggle category status
     */
    public function toggleStatus(Request $request, Category $category)
    {
        $category->update(['status' => !$category->status]);
        return response()->json([
            'success' => true,
            'status' => $category->status,
            'message' => 'Category status updated successfully!'
        ]);
    }

    /**
     * Store a newly created subcategory
     */
    public function storeSubcategory(Request $request)
{
    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name'        => 'required|string|max:255',
        'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status'      => 'nullable',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('subcategories', 'public');
    }

    Subcategory::create([
        'category_id' => $validated['category_id'],
        'name'        => $validated['name'],
        'image'       => $imagePath,
        'status'      => $request->has('status') ? 1 : 0, // ✅ default handle
    ]);

    return redirect()->route('admin.categories.index')
        ->with('success', 'Subcategory added successfully!');
}


    /**
     * Display the specified subcategory
     */
    public function showSubcategory(Subcategory $category)
    {
        $category->load('category');
        return view('admin.subcategories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified subcategory
     */
    public function editSubcategory(Subcategory $category)
    {
        $categories = Category::active()->orderBy('name', 'asc')->get();
        return view('admin.subcategories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified subcategory
     */
    public function updateSubcategory(Request $request, Subcategory $category)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean'
        ]);

        // Handle image upload
        $imagePath = $category->image;
        if ($request->hasFile('image')) {
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            $imagePath = $request->file('image')->store('subcategories', 'public');
        }

        // Update subcategory
        $category->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'image' => $imagePath,
            'status' => $validated['status'] ?? 0
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Subcategory updated successfully!');
    }

    /**
     * Remove the specified subcategory
     */
    public function destroySubcategory(Subcategory $category)
    {
        // Delete image if exists
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        // Delete subcategory
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Subcategory deleted successfully!');
    }

    /**
     * Toggle subcategory status
     */
    public function toggleSubcategoryStatus(Request $request, Subcategory $category)
    {
        $category->update(['status' => !$category->status]);
        return response()->json([
            'success' => true,
            'status' => $category->status,
            'message' => 'Subcategory status updated successfully!'
        ]);
    }
}