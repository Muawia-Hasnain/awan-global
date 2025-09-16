<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
                          ->latest()
                          ->paginate(15);
        
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::active()->get();
        return view('admin.products.create', compact('categories'));
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'subcategory_id' => 'nullable|exists:subcategories,id', // Added subcategory validation
        'short_description' => 'nullable|string|max:500',
        'description' => 'nullable|string',
        'retail_price' => 'nullable|numeric|min:0',
        'wholesale_price' => 'nullable|numeric|min:0',
        'wholesale_min_qty' => 'required|integer|min:1',
        'stock_quantity' => 'required|integer|min:0',
        'product_type' => 'required|in:retail,wholesale,both',
        'weight' => 'nullable|numeric|min:0',
        'weight_unit' => 'nullable|string|in:kg,g,lb,oz',
        'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Made required as per your form
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $data = $request->all();
    
    // 🔧 FIX: Handle checkbox values properly
    $data['status'] = $request->has('status') ? 1 : 0;
    $data['manage_stock'] = $request->has('manage_stock') ? 1 : 0;
    
    // 🔧 FIX: Handle subcategory - set to null if empty
    $data['subcategory_id'] = $request->filled('subcategory_id') ? $request->subcategory_id : null;
    
    // Generate SKU if not provided
    if (empty($data['sku'])) {
        $data['sku'] = 'AWN-' . strtoupper(Str::random(6));
    }

    // 🔧 FIX: Auto set stock_status based on stock_quantity
    $data['stock_status'] = $data['stock_quantity'] > 0 ? 'in_stock' : 'out_of_stock';

    // Handle featured image upload
    if ($request->hasFile('featured_image')) {
        $data['featured_image'] = $request->file('featured_image')
                                          ->store('products', 'public');
    }

    // Handle multiple images upload
    $images = [];
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $images[] = $image->store('products', 'public');
        }
        $data['images'] = $images;
    }

    // 🔧 FIX: Remove any fields that shouldn't be in database
    unset($data['_token'], $data['images']); // Remove _token and handle images separately
    if (!empty($images)) {
        $data['images'] = $images;
    }

    try {
        $product = Product::create($data);

        return redirect()->route('admin.dashboard')
                        ->with('success', 'Product "' . $product->name . '" created successfully!');
                        
    } catch (\Exception $e) {
        // Log error for debugging
        \Log::error('Product creation failed: ' . $e->getMessage());
        
        return back()
               ->withInput()
               ->with('error', 'Failed to create product. Please try again.');
    }
}
    public function show(Product $product)
    {
        $product->load('category');
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::active()->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'retail_price' => 'nullable|numeric|min:0',
            'wholesale_price' => 'nullable|numeric|min:0',
            'wholesale_min_qty' => 'required|integer|min:1',
            'stock_quantity' => 'required|integer|min:0',
            'product_type' => 'required|in:retail,wholesale,both',
            'weight' => 'nullable|numeric|min:0',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old featured image
            if ($product->featured_image) {
                Storage::disk('public')->delete($product->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')
                                              ->store('products', 'public');
        }

        // Handle multiple images upload
        if ($request->hasFile('images')) {
            // Delete old images
            if ($product->images) {
                foreach ($product->images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
            
            $images = [];
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('products', 'public');
            }
            $data['images'] = $images;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
                        ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        // Delete images
        if ($product->featured_image) {
            Storage::disk('public')->delete($product->featured_image);
        }
        
        if ($product->images) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')
                        ->with('success', 'Product deleted successfully!');
    }

    // Toggle product status
    public function toggleStatus(Product $product)
    {
        $product->update(['status' => !$product->status]);
        
        return response()->json([
            'success' => true,
            'status' => $product->status,
            'message' => 'Product status updated successfully!'
        ]);
    }

    // Toggle featured status
    public function toggleFeatured(Product $product)
    {
        $product->update(['is_featured' => !$product->is_featured]);
        
        return response()->json([
            'success' => true,
            'is_featured' => $product->is_featured,
            'message' => 'Featured status updated successfully!'
        ]);
    }
}
