<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Dashboard statistics
        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_orders' => Order::count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'retail_products' => Product::retail()->count(),
            'wholesale_products' => Product::wholesale()->count(),
            'total_subcategories' => Subcategory::count(), // New subcategories stat
            'out_of_stock' => Product::where('stock_status', 'out_of_stock')->count()
        ];

        // Recent products with category and subcategory relationships
        $recent_products = Product::with(['category', 'subcategory'])
                                ->latest()
                                ->take(5)
                                ->get();

        // Recent orders (when order model is ready)
        // $recent_orders = Order::with('user')->latest()->take(5)->get();

        // For quick-add product modal
        $categories = Category::active()->orderBy('name')->get();

        return view('admin.dashboard', compact('stats', 'recent_products', 'categories'));
    }

    /**
     * AJAX route to get subcategories by category ID
     * For dynamic dropdown in Quick Add Product modal
     */
    public function getSubcategories($categoryId)
    {
        try {
            $subcategories = Subcategory::where('category_id', $categoryId)
                                      ->where('status', 1)
                                      ->orderBy('name')
                                      ->select('id', 'name')
                                      ->get();

            return response()->json([
                'success' => true,
                'subcategories' => $subcategories
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading subcategories'
            ], 500);
        }
    }
}