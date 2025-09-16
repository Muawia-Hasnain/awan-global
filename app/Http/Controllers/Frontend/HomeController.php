<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->active()
            ->retail()
            ->inStock()
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::query()
            ->active() // Only active categories
            ->latest()
            ->get();

        return view('frontend.home.index', compact('products', 'categories'));
    }

    public function about()
    {
        return view('frontend.home.about');
    }

    public function contact()
    {
        return view('frontend.home.contact');
    }

    public function privacyPolicy()
    {
        return view('frontend.home.privacy-policy');
    }
}