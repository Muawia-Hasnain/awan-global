@extends('frontend.layouts.app')

@section('title', 'Shop Fresh Groceries - Awan Global Foods')

@section('content')

@php
    // 🔹 Dummy categories
    $categories = [
        (object)['id' => 1, 'name' => 'Fruits & Vegetables', 'slug' => 'fruits-vegetables', 'icon' => '🥬', 'count' => 45],
        (object)['id' => 2, 'name' => 'Dairy & Eggs', 'slug' => 'dairy-eggs', 'icon' => '🥛', 'count' => 23],
        (object)['id' => 3, 'name' => 'Meat & Seafood', 'slug' => 'meat-seafood', 'icon' => '🍗', 'count' => 18],
        (object)['id' => 4, 'name' => 'Rice & Grains', 'slug' => 'rice-grains', 'icon' => '🍚', 'count' => 32],
        (object)['id' => 5, 'name' => 'Cooking Oil', 'slug' => 'cooking-oil', 'icon' => '🫒', 'count' => 15],
        (object)['id' => 6, 'name' => 'Spices & Herbs', 'slug' => 'spices-herbs', 'icon' => '🌶️', 'count' => 28],
        (object)['id' => 7, 'name' => 'Bakery Items', 'slug' => 'bakery', 'icon' => '🍞', 'count' => 12],
        (object)['id' => 8, 'name' => 'Beverages', 'slug' => 'beverages', 'icon' => '🥤', 'count' => 35],
    ];

    // 🔹 Dummy products
    $products = [
        (object)[
            'id' => 1, 'name' => 'Fresh Basmati Rice', 'slug' => 'fresh-basmati-rice',
            'price' => 250, 'original_price' => 280, 'image' => 'https://via.placeholder.com/300x300/16a34a/ffffff?text=Rice',
            'category' => 'Rice & Grains', 'rating' => 4.5, 'reviews_count' => 128, 'in_stock' => true,
            'is_featured' => true, 'discount_percentage' => 11
        ],
        (object)[
            'id' => 2, 'name' => 'Organic Tomatoes', 'slug' => 'organic-tomatoes',
            'price' => 80, 'original_price' => 90, 'image' => 'https://via.placeholder.com/300x300/ef4444/ffffff?text=🍅',
            'category' => 'Fruits & Vegetables', 'rating' => 4.2, 'reviews_count' => 67, 'in_stock' => true,
            'is_featured' => false, 'discount_percentage' => 11
        ],
        (object)[
            'id' => 3, 'name' => 'Premium Cooking Oil', 'slug' => 'premium-cooking-oil',
            'price' => 450, 'original_price' => 500, 'image' => 'https://via.placeholder.com/300x300/f59e0b/ffffff?text=Oil',
            'category' => 'Cooking Oil', 'rating' => 4.7, 'reviews_count' => 89, 'in_stock' => true,
            'is_featured' => true, 'discount_percentage' => 10
        ],
        (object)[
            'id' => 4, 'name' => 'Fresh Whole Chicken', 'slug' => 'fresh-whole-chicken',
            'price' => 350, 'original_price' => 380, 'image' => 'https://via.placeholder.com/300x300/8b5cf6/ffffff?text=🍗',
            'category' => 'Meat & Seafood', 'rating' => 4.3, 'reviews_count' => 45, 'in_stock' => true,
            'is_featured' => false, 'discount_percentage' => 8
        ],
        (object)[
            'id' => 5, 'name' => 'Farm Fresh Milk', 'slug' => 'farm-fresh-milk',
            'price' => 120, 'original_price' => 130, 'image' => 'https://via.placeholder.com/300x300/06b6d4/ffffff?text=🥛',
            'category' => 'Dairy & Eggs', 'rating' => 4.6, 'reviews_count' => 156, 'in_stock' => true,
            'is_featured' => true, 'discount_percentage' => 8
        ],
        (object)[
            'id' => 6, 'name' => 'Red Chili Powder', 'slug' => 'red-chili-powder',
            'price' => 180, 'original_price' => 200, 'image' => 'https://via.placeholder.com/300x300/dc2626/ffffff?text=🌶️',
            'category' => 'Spices & Herbs', 'rating' => 4.4, 'reviews_count' => 73, 'in_stock' => false,
            'is_featured' => false, 'discount_percentage' => 10
        ],
        (object)[
            'id' => 7, 'name' => 'Fresh Bread Loaf', 'slug' => 'fresh-bread-loaf',
            'price' => 60, 'original_price' => 70, 'image' => 'https://via.placeholder.com/300x300/92400e/ffffff?text=🍞',
            'category' => 'Bakery Items', 'rating' => 4.1, 'reviews_count' => 34, 'in_stock' => true,
            'is_featured' => false, 'discount_percentage' => 14
        ],
        (object)[
            'id' => 8, 'name' => 'Fresh Orange Juice', 'slug' => 'fresh-orange-juice',
            'price' => 150, 'original_price' => 170, 'image' => 'https://via.placeholder.com/300x300/ea580c/ffffff?text=🧃',
            'category' => 'Beverages', 'rating' => 4.0, 'reviews_count' => 29, 'in_stock' => true,
            'is_featured' => false, 'discount_percentage' => 12
        ]
    ];

    $selectedCategory = request('category', 'all');
    $sortBy = request('sort', 'featured');
    $priceRange = request('price_range', 'all');
@endphp

<style>
.products-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

.products-header {
    text-align: center;
    margin-bottom: 3rem;
}

.products-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: #111827;
    margin-bottom: 0.5rem;
}

.products-subtitle {
    color: #6b7280;
    font-size: 1.1rem;
    max-width: 600px;
    margin: 0 auto;
}

.breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 2rem;
    font-size: 0.875rem;
    color: #6b7280;
}

.breadcrumb a {
    color: #16a34a;
    text-decoration: none;
}

.breadcrumb a:hover {
    text-decoration: underline;
}

.products-main {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 2rem;
    align-items: start;
}

.filters-sidebar {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    border: 1px solid #e5e7eb;
    position: sticky;
    top: 2rem;
    height: fit-content;
}

.filter-section {
    margin-bottom: 2rem;
}

.filter-section:last-child {
    margin-bottom: 0;
}

.filter-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #111827;
    margin-bottom: 1rem;
}

.categories-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.category-item {
    margin-bottom: 0.5rem;
}

.category-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.5rem;
    border-radius: 6px;
    color: #374151;
    text-decoration: none;
    transition: all 0.2s;
}

.category-link:hover,
.category-link.active {
    background: #f0fdf4;
    color: #16a34a;
    text-decoration: none;
}

.category-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.category-count {
    font-size: 0.75rem;
    background: #f3f4f6;
    color: #6b7280;
    padding: 0.125rem 0.375rem;
    border-radius: 10px;
    min-width: 20px;
    text-align: center;
}

.price-ranges {
    list-style: none;
    padding: 0;
    margin: 0;
}

.price-ranges li {
    margin-bottom: 0.5rem;
}

.price-ranges label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 4px;
    transition: background 0.2s;
}

.price-ranges label:hover {
    background: #f9fafb;
}

.products-content {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    border: 1px solid #e5e7eb;
}

.products-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #f3f4f6;
}

.results-count {
    color: #6b7280;
    font-size: 0.875rem;
}

.toolbar-right {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.view-toggle {
    display: flex;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    overflow: hidden;
}

.view-btn {
    padding: 0.5rem;
    border: none;
    background: white;
    color: #6b7280;
    cursor: pointer;
    transition: all 0.2s;
}

.view-btn.active,
.view-btn:hover {
    background: #16a34a;
    color: white;
}

.sort-select {
    padding: 0.5rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    background: white;
    color: #374151;
    cursor: pointer;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
}

.product-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #f3f4f6;
    transition: all 0.3s;
    position: relative;
    cursor: pointer;
}

.product-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    border-color: #16a34a;
}

.product-image {
    position: relative;
    overflow: hidden;
}

.product-image img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.product-badge {
    position: absolute;
    top: 0.75rem;
    left: 0.75rem;
    background: #ef4444;
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.featured-badge {
    background: #16a34a;
}

.out-of-stock-badge {
    background: #6b7280;
}

.product-actions {
    position: absolute;
    top: 0.75rem;
    right: 0.75rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    opacity: 0;
    transition: opacity 0.3s;
}

.product-card:hover .product-actions {
    opacity: 1;
}

.action-btn {
    width: 36px;
    height: 36px;
    border: none;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.9);
    color: #374151;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 0.875rem;
}

.action-btn:hover {
    background: #16a34a;
    color: white;
    transform: scale(1.1);
}

.product-info {
    padding: 1rem;
}

.product-category {
    font-size: 0.75rem;
    color: #16a34a;
    font-weight: 500;
    margin-bottom: 0.25rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.product-name {
    font-size: 1rem;
    font-weight: 600;
    color: #111827;
    margin-bottom: 0.5rem;
    line-height: 1.3;
}

.product-rating {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    margin-bottom: 0.75rem;
}

.stars {
    color: #fbbf24;
    font-size: 0.875rem;
}

.rating-count {
    font-size: 0.75rem;
    color: #6b7280;
}

.product-pricing {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.price-group {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.current-price {
    font-size: 1.25rem;
    font-weight: bold;
    color: #16a34a;
}

.original-price {
    font-size: 0.875rem;
    color: #6b7280;
    text-decoration: line-through;
}

.discount-percent {
    background: #fee2e2;
    color: #dc2626;
    padding: 0.125rem 0.375rem;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 500;
}

.add-to-cart-btn {
    width: 100%;
    background: #16a34a;
    color: white;
    border: none;
    padding: 0.75rem;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}

.add-to-cart-btn:hover {
    background: #15803d;
    transform: translateY(-1px);
}

.add-to-cart-btn:disabled {
    background: #d1d5db;
    color: #9ca3af;
    cursor: not-allowed;
    transform: none;
}

.pagination {
    display: flex;
    justify-content: center;
    margin-top: 3rem;
    gap: 0.5rem;
}

.page-btn {
    padding: 0.5rem 1rem;
    border: 1px solid #e5e7eb;
    background: white;
    color: #374151;
    text-decoration: none;
    border-radius: 6px;
    transition: all 0.2s;
}

.page-btn:hover,
.page-btn.active {
    background: #16a34a;
    color: white;
    border-color: #16a34a;
    text-decoration: none;
}

.mobile-filters-toggle {
    display: none;
    background: #16a34a;
    color: white;
    border: none;
    padding: 0.75rem 1rem;
    border-radius: 6px;
    margin-bottom: 1rem;
    cursor: pointer;
    font-weight: 500;
}

@media (max-width: 768px) {
    .products-main {
        grid-template-columns: 1fr;
    }
    
    .filters-sidebar {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: white;
        z-index: 1000;
        padding: 2rem;
        overflow-y: auto;
    }
    
    .filters-sidebar.show {
        display: block;
    }
    
    .mobile-filters-toggle {
        display: block;
    }
    
    .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1rem;
    }
    
    .products-toolbar {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .toolbar-right {
        justify-content: space-between;
    }
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: #6b7280;
}

.empty-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
}

.clear-filters-btn {
    background: #ef4444;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    margin-top: 1rem;
}
</style>

<div class="products-container">
    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="{{ route('home') ?? '/' }}">🏠 Home</a>
        <span>→</span>
        <span>Shop</span>
        @if($selectedCategory !== 'all')
            <span>→</span>
            <span>{{ ucfirst(str_replace('-', ' ', $selectedCategory)) }}</span>
        @endif
    </nav>

    <!-- Page Header -->
    <div class="products-header">
        <h1 class="products-title">🛍️ Fresh Groceries</h1>
        <p class="products-subtitle">
            Discover our wide selection of fresh, quality products delivered right to your doorstep
        </p>
    </div>

    <div class="products-main">
        <!-- Filters Sidebar -->
        <aside class="filters-sidebar" id="filters-sidebar">
            <div class="filter-section">
                <button class="mobile-close-btn" onclick="toggleMobileFilters()" style="display: none; float: right; background: none; border: none; font-size: 1.5rem; cursor: pointer;">×</button>
                
                <h3 class="filter-title">🗂️ Categories</h3>
                <ul class="categories-list">
                    <li class="category-item">
                        <a href="?category=all&sort={{ $sortBy }}&price_range={{ $priceRange }}" 
                           class="category-link {{ $selectedCategory === 'all' ? 'active' : '' }}">
                            <div class="category-info">
                                <span>🛒</span>
                                <span>All Products</span>
                            </div>
                            <span class="category-count">{{ count($products) }}</span>
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <li class="category-item">
                            <a href="?category={{ $category->slug }}&sort={{ $sortBy }}&price_range={{ $priceRange }}" 
                               class="category-link {{ $selectedCategory === $category->slug ? 'active' : '' }}">
                                <div class="category-info">
                                    <span>{{ $category->icon }}</span>
                                    <span>{{ $category->name }}</span>
                                </div>
                                <span class="category-count">{{ $category->count }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="filter-section">
                <h3 class="filter-title">💰 Price Range</h3>
                <ul class="price-ranges">
                    <li>
                        <label>
                            <input type="radio" name="price_range" value="all" {{ $priceRange === 'all' ? 'checked' : '' }}>
                            <span>All Prices</span>
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="radio" name="price_range" value="under-100" {{ $priceRange === 'under-100' ? 'checked' : '' }}>
                            <span>Under ₹100</span>
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="radio" name="price_range" value="100-300" {{ $priceRange === '100-300' ? 'checked' : '' }}>
                            <span>₹100 - ₹300</span>
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="radio" name="price_range" value="300-500" {{ $priceRange === '300-500' ? 'checked' : '' }}>
                            <span>₹300 - ₹500</span>
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="radio" name="price_range" value="above-500" {{ $priceRange === 'above-500' ? 'checked' : '' }}>
                            <span>Above ₹500</span>
                        </label>
                    </li>
                </ul>
            </div>

            <div class="filter-section">
                <h3 class="filter-title">⭐ Rating</h3>
                <ul class="price-ranges">
                    <li>
                        <label>
                            <input type="checkbox">
                            <span>4+ Stars</span>
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox">
                            <span>3+ Stars</span>
                        </label>
                    </li>
                </ul>
            </div>

            <button class="clear-filters-btn" onclick="clearFilters()">
                🗑️ Clear All Filters
            </button>
        </aside>

        <!-- Products Content -->
        <div class="products-content">
            <!-- Mobile Filters Toggle -->
            <button class="mobile-filters-toggle" onclick="toggleMobileFilters()">
                🔽 Filters & Categories
            </button>

            <!-- Products Toolbar -->
            <div class="products-toolbar">
                <div class="results-count">
                    Showing {{ count($products) }} products
                </div>
                
                <div class="toolbar-right">
                    <div class="view-toggle">
                        <button class="view-btn active" title="Grid View">⊞</button>
                        <button class="view-btn" title="List View">☰</button>
                    </div>
                    
                    <select class="sort-select" onchange="updateSort(this.value)">
                        <option value="featured" {{ $sortBy === 'featured' ? 'selected' : '' }}>Featured</option>
                        <option value="price-low" {{ $sortBy === 'price-low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price-high" {{ $sortBy === 'price-high' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="rating" {{ $sortBy === 'rating' ? 'selected' : '' }}>Highest Rated</option>
                        <option value="newest" {{ $sortBy === 'newest' ? 'selected' : '' }}>Newest</option>
                    </select>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="products-grid" id="products-grid">
                @forelse($products as $product)
                    <div class="product-card" onclick="goToProduct('{{ $product->slug }}')">
                        <div class="product-image">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" loading="lazy">
                            
                            <!-- Product Badges -->
                            @if($product->is_featured)
                                <span class="product-badge featured-badge">⭐ Featured</span>
                            @elseif($product->discount_percentage > 0)
                                <span class="product-badge">{{ $product->discount_percentage }}% OFF</span>
                            @endif
                            
                            @if(!$product->in_stock)
                                <span class="product-badge out-of-stock-badge">Out of Stock</span>
                            @endif
                            
                            <!-- Quick Actions -->
                            <div class="product-actions">
                                <button class="action-btn" onclick="addToWishlist({{ $product->id }}, event)" title="Add to Wishlist">
                                    ❤️
                                </button>
                                <button class="action-btn" onclick="quickView({{ $product->id }}, event)" title="Quick View">
                                    👁️
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-info">
                            <div class="product-category">{{ $product->category }}</div>
                            <h3 class="product-name">{{ $product->name }}</h3>
                            
                            <div class="product-rating">
                                <div class="stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($product->rating))
                                            ⭐
                                        @elseif($i - 0.5 <= $product->rating)
                                            ⭐
                                        @else
                                            ☆
                                        @endif
                                    @endfor
                                </div>
                                <span class="rating-count">({{ $product->reviews_count }})</span>
                            </div>
                            
                            <div class="product-pricing">
                                <div class="price-group">
                                    <span class="current-price">₹{{ number_format($product->price) }}</span>
                                    @if($product->original_price > $product->price)
                                        <span class="original-price">₹{{ number_format($product->original_price) }}</span>
                                    @endif
                                </div>
                                @if($product->discount_percentage > 0)
                                    <span class="discount-percent">{{ $product->discount_percentage }}% OFF</span>
                                @endif
                            </div>
                            
                            <button class="add-to-cart-btn" 
                                    onclick="addToCart({{ $product->id }}, event)"
                                    {{ !$product->in_stock ? 'disabled' : '' }}>
                                @if($product->in_stock)
                                    🛒 Add to Cart
                                @else
                                    Out of Stock
                                @endif
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-icon">🔍</div>
                        <h3>No products found</h3>
                        <p>Try adjusting your filters or search terms</p>
                        <button class="clear-filters-btn" onclick="clearFilters()">
                            Clear Filters
                        </button>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if(count($products) > 0)
                <div class="pagination">
                    <a href="#" class="page-btn">← Previous</a>
                    <a href="#" class="page-btn active">1</a>
                    <a href="#" class="page-btn">2</a>
                    <a href="#" class="page-btn">3</a>
                    <a href="#" class="page-btn">Next →</a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
// Mobile filters toggle
function toggleMobileFilters() {
    const sidebar = document.getElementById('filters-sidebar');
    sidebar.classList.toggle('show');
    
    if (window.innerWidth <= 768) {
        document.querySelector('.mobile-close-btn').style.display = 
            sidebar.classList.contains('show') ? 'block' : 'none';
    }
}

// Sort change handler
function updateSort(sortValue) {
    const url = new URL(window.location);
    url.searchParams.set('sort', sortValue);
    window.location = url;
}

// Price range filter
document.querySelectorAll('input[name="price_range"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const url = new URL(window.location);
        url.searchParams.set('price_range', this.value);
        window.location = url;
    });
});

// Clear filters
function clearFilters() {
    const url = new URL(window.location);
    url.searchParams.delete('category');
    url.searchParams.delete('price_range');
    url.searchParams.delete('sort');
    window.location = url.pathname;
}

// Go to product detail
function goToProduct(slug) {
    window.location.href = `/products/${slug}`;
}

// Add to cart function
function addToCart(productId, event) {
    event.stopPropagation();
    
    // Show loading state
    const btn = event.target;
    const originalText = btn.textContent;
    btn.textContent = '⏳ Adding...';
    btn.disabled = true;
    
    // Simulate API call
    setTimeout(() => {
        // Here you would make an actual AJAX call to add to cart
        console.log(`Added product ${productId} to cart`);
        
        // Show success feedback
        btn.textContent = '✓ Added!';
        btn.style.background = '#16a34a';
        
        // Reset button after 2 seconds
        setTimeout(() => {
            btn.textContent = originalText;
            btn.disabled = false;
            btn.style.background = '';
        }, 2000);
        
        // Update cart count in header (if you have one)
        updateCartCount();
        
    }, 500);
}

// Add to wishlist function
function addToWishlist(productId, event) {
    event.stopPropagation();
    
    // Check if user is logged in
    const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
    
    if (!isLoggedIn) {
        alert('Please login to add items to wishlist');
        return;
    }
    
    const btn = event.target;
    
    // Toggle wishlist state
    if (btn.style.color === 'red') {
        btn.style.color = '';
        btn.title = 'Add to Wishlist';
        console.log(`Removed product ${productId} from wishlist`);
    } else {
        btn.style.color = 'red';
        btn.title = 'Remove from Wishlist';
        console.log(`Added product ${productId} to wishlist`);
    }
}

// Quick view function
function quickView(productId, event) {
    event.stopPropagation();
    
    // Here you would open a modal with product details
    console.log(`Quick view for product ${productId}`);
    alert('Quick view feature coming soon!');
}

// Update cart count (placeholder)
function updateCartCount() {
    // This would update the cart count in your header
    console.log('Cart count updated');
}

// View toggle functionality
document.querySelectorAll('.view-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        const grid = document.getElementById('products-grid');
        if (this.textContent === '☰') {
            // List view
            grid.style.gridTemplateColumns = '1fr';
            grid.querySelectorAll('.product-card').forEach(card => {
                card.style.display = 'flex';
                card.style.height = '150px';
            });
        } else {
            // Grid view
            grid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(280px, 1fr))';
            grid.querySelectorAll('.product-card').forEach(card => {
                card.style.display = 'block';
                card.style.height = 'auto';
            });
        }
    });
});

// Lazy loading for images
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src || img.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });

    document.querySelectorAll('img[loading="lazy"]').forEach(img => {
        imageObserver.observe(img);
    });
}

// Smooth scroll to top when filters change
function smoothScrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Close mobile filters when clicking outside
document.addEventListener('click', function(event) {
    const sidebar = document.getElementById('filters-sidebar');
    const toggleBtn = document.querySelector('.mobile-filters-toggle');
    
    if (window.innerWidth <= 768 && 
        sidebar.classList.contains('show') && 
        !sidebar.contains(event.target) && 
        !toggleBtn.contains(event.target)) {
        sidebar.classList.remove('show');
        document.querySelector('.mobile-close-btn').style.display = 'none';
    }
});

// Keyboard shortcuts
document.addEventListener('keydown', function(event) {
    // Escape key to close mobile filters
    if (event.key === 'Escape') {
        const sidebar = document.getElementById('filters-sidebar');
        if (sidebar.classList.contains('show')) {
            toggleMobileFilters();
        }
    }
    
    // Ctrl/Cmd + F to focus search (if you add search later)
    if ((event.ctrlKey || event.metaKey) && event.key === 'f') {
        event.preventDefault();
        // Focus search input when implemented
    }
});

// Performance: Debounce scroll events
let scrollTimer;
window.addEventListener('scroll', function() {
    clearTimeout(scrollTimer);
    scrollTimer = setTimeout(function() {
        // Add scroll-based functionality here if needed
        // e.g., showing/hiding filters on scroll
    }, 100);
});

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    // Set focus on first product for accessibility
    const firstProduct = document.querySelector('.product-card');
    if (firstProduct) {
        firstProduct.setAttribute('tabindex', '0');
    }
    
    // Initialize any tooltips or popovers
    initializeTooltips();
});

function initializeTooltips() {
    // Add tooltip functionality for action buttons
    document.querySelectorAll('.action-btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            // Show tooltip
        });
        
        btn.addEventListener('mouseleave', function() {
            // Hide tooltip
        });
    });
}

// Add analytics tracking (placeholder)
function trackProductView(productId) {
    // Track product views for analytics
    console.log(`Product ${productId} viewed`);
}

function trackAddToCart(productId) {
    // Track add to cart events
    console.log(`Product ${productId} added to cart`);
}

// Auto-refresh out of stock products (every 5 minutes)
setInterval(function() {
    // Check for stock updates
    console.log('Checking stock updates...');
}, 300000);
</script>

@endsection