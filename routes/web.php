<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as CategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use Illuminate\Support\Facades\Route;

// Frontend Controllers
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\AccountController as CustomerAccountController;
use App\Http\Controllers\Frontend\OrderController as CustomerOrderController;
use App\Http\Controllers\Frontend\AddressController as CustomerAddressController;
use App\Http\Controllers\Frontend\WishlistController as CustomerWishlistController;
use App\Http\Controllers\Frontend\ReviewController as CustomerReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
// Public Routes (No Login Required)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('pages.about');
Route::get('/contact', [PageController::class, 'contact'])->name('pages.contact');
Route::get('/products', [ProductController::class, 'index'])->name('products');

// Cart routes - PUBLIC ACCESS (guest checkout ke liye)
Route::resource('cart', CartController::class);
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Checkout - AUTH REQUIRED
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
});

// ✅ Admin Routes - Fixed Version
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    
    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // 🔧 NEW: AJAX route for subcategories dropdown
    Route::get('/get-subcategories/{category_id}', [AdminController::class, 'getSubcategories'])->name('get-subcategories');
    
    // Product Management
    Route::resource('products', AdminProductController::class);
    Route::post('products/{product}/toggle-status', [AdminProductController::class, 'toggleStatus'])->name('products.toggle-status');
    // 🔧 REMOVED: toggle-featured route since is_featured column is deleted
    // Route::post('products/{product}/toggle-featured', [AdminProductController::class, 'toggleFeatured'])->name('products.toggle-featured');
    
    // ====================================================
    // 🔧 FIXED: Category Management - Clear Separation
    // ====================================================
    Route::resource('categories', CategoryController::class);
    Route::post('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggle-status');
    
    // 🔧 FIXED: Subcategory Management - Dedicated Routes
    // Uses same controller but different methods for clarity
    Route::prefix('subcategories')->name('subcategories.')->group(function () {
        Route::get('/', [CategoryController::class, 'indexSubcategory'])->name('index'); // Added index route
        Route::get('/create', [CategoryController::class, 'createSubcategory'])->name('create'); // Added create route
        Route::post('/', [CategoryController::class, 'storeSubcategory'])->name('store');
        Route::get('/{subcategory}', [CategoryController::class, 'showSubcategory'])->name('show');
        Route::get('/{subcategory}/edit', [CategoryController::class, 'editSubcategory'])->name('edit');
        Route::put('/{subcategory}', [CategoryController::class, 'updateSubcategory'])->name('update');
        Route::delete('/{subcategory}', [CategoryController::class, 'destroySubcategory'])->name('destroy');
        Route::post('/{subcategory}/toggle-status', [CategoryController::class, 'toggleSubcategoryStatus'])->name('toggle-status');
    });
    
    // Orders Management
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show']);
    
    // Customers Management
    Route::resource('customers', AdminCustomerController::class);
    
    // Wholesale Inquiries Management
    Route::resource('inquiries', AdminInquiryController::class);
    
    // Settings & Configuration
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
});


// ✅ Customer Routes - Sirf Customer Access
Route::prefix('customer')->name('customer.')->middleware(['auth', 'role:customer'])->group(function () {
    // Customer Dashboard
    Route::get('/dashboard', [CustomerAccountController::class, 'dashboard'])->name('dashboard');
    // Profile Management (simple views)
    Route::get('/profile', [CustomerAccountController::class, 'profile'])->name('profile');
    Route::get('/change-password', [CustomerAccountController::class, 'changePassword'])->name('change.password');
    // Orders
    Route::get('/orders', [CustomerOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [CustomerOrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{id}/track', [CustomerOrderController::class, 'track'])->name('orders.track');
    // Addresses
    Route::get('/addresses', [CustomerAddressController::class, 'index'])->name('addresses.index');
    Route::get('/addresses/create', [CustomerAddressController::class, 'create'])->name('addresses.create');
    Route::get('/addresses/{id}/edit', [CustomerAddressController::class, 'edit'])->name('addresses.edit');
    // Wishlist
    Route::get('/wishlist', [CustomerWishlistController::class, 'index'])->name('wishlist.index');
    // Reviews
    Route::get('/reviews', [CustomerReviewController::class, 'index'])->name('reviews.index');
});

// ✅ Authenticated User Routes (Any Role)
Route::middleware(['auth'])->group(function () {
    // Checkout Routes (Customer Only)
    Route::middleware(['role:customer'])->group(function () {
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
        Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
        Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
    });
    // Cart Routes (Authenticated Users)
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
});

// ✅ Public Frontend Routes (No Authentication Required)
// Product Routes (Public Access)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/category/{id}', [ProductController::class, 'category'])->name('products.category');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/compare', [ProductController::class, 'compare'])->name('products.compare');

// Cart Routes (Public Access - Guest Cart)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

// Blog Routes (placeholder controllers removed if non-existent)
// Support Routes (Public)
Route::get('/help', [PageController::class, 'help'])->name('support.help');
Route::get('/faq', [PageController::class, 'faq'])->name('support.faq');
Route::get('/live-chat', [PageController::class, 'liveChat'])->name('support.live.chat');

// Deals & Offers Routes
Route::get('/deals', [PageController::class, 'deals'])->name('deals.index');
Route::get('/flash-sale', [PageController::class, 'flashSale'])->name('deals.flash.sale');
Route::get('/coupons', [PageController::class, 'coupons'])->name('deals.coupons');
Route::get('/special-offers', [PageController::class, 'specialOffers'])->name('deals.special.offers');

// Wholesale Routes
Route::get('/wholesale-inquiry', [PageController::class, 'wholesale'])->name('pages.wholesale');
Route::post('/wholesale-inquiry', [PageController::class, 'wholesaleStore'])->name('wholesale.store');

// Newsletter Routes
Route::post('/newsletter/subscribe', [PageController::class, 'newsletterSubscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{token}', [PageController::class, 'newsletterUnsubscribe'])->name('newsletter.unsubscribe');

// Vendor Routes (If needed)
Route::get('/vendors', [PageController::class, 'vendors'])->name('vendors.index');
Route::get('/vendors/{slug}', [PageController::class, 'vendorShow'])->name('vendors.show');

// Gift Cards & Loyalty Routes
Route::get('/gift-cards', [PageController::class, 'giftCards'])->name('gift.cards');
Route::get('/loyalty-program', [PageController::class, 'loyaltyProgram'])->name('loyalty.program');

// AJAX Routes for Components
Route::get('/api/recently-viewed', [ProductController::class, 'recentlyViewed'])->name('api.recently.viewed');
Route::get('/api/related-products/{id}', [ProductController::class, 'relatedProducts'])->name('api.related.products');
Route::post('/api/product-review', [ProductController::class, 'submitReview'])->name('api.product.review');

require __DIR__.'/auth.php';