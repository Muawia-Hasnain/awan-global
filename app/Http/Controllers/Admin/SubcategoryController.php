<?php
// app/Http/Controllers/Admin/SubcategoryController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of subcategories
     */
    public function index()
    {
        $subcategories = Subcategory::with('category')
            ->orderBy('name', 'asc')
            ->paginate(20);

        return view('admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new subcategory
     */
    public function create()
    {
        $categories = Category::active()->orderBy('name', 'asc')->get();
        return view('admin.subcategories.create', compact('categories'));
    }

    /**
     * Store a newly created subcategory
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean'
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('subcategories', 'public');
        }

        // Create subcategory
        Subcategory::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'image' => $imagePath,
            'status' => $validated['status'] ?? 0

        ]);

        return redirect()->route('admin.subcategories.index')
            ->with('success', 'Subcategory created successfully!');
    }

    /**
     * Display the specified subcategory
     */
    public function show(Subcategory $subcategory)
    {
        $subcategory->load('category');
        return view('admin.subcategories.show', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified subcategory
     */
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::active()->orderBy('name', 'asc')->get();
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified subcategory
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean'
        ]);

        // Handle image upload
        $imagePath = $subcategory->image;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($subcategory->image && Storage::disk('public')->exists($subcategory->image)) {
                Storage::disk('public')->delete($subcategory->image);
            }
            $imagePath = $request->file('image')->store('subcategories', 'public');
        }

        // Update subcategory
        $subcategory->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'image' => $imagePath,
            'status' =>  $validated['status'] ?? 0
        ]);

        return redirect()->route('admin.subcategories.index')
            ->with('success', 'Subcategory updated successfully!');
    }

    /**
     * Remove the specified subcategory
     */
    public function destroy(Subcategory $subcategory)
    {
        // Delete image if exists
        if ($subcategory->image && Storage::disk('public')->exists($subcategory->image)) {
            Storage::disk('public')->delete($subcategory->image);
        }

        // Delete subcategory
        $subcategory->delete();

        return redirect()->route('admin.subcategories.index')
            ->with('success', 'Subcategory deleted successfully!');
    }
}