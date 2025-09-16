<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Premium dry fruits and food products at Awan Global Foods">
    <title>Awan Global Foods - Premium Dry Fruits</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #ff6b35;
            --secondary-color: #f39c12;
            --dark-color: #2c3e50;
            --light-bg: #f8f9fa;
        }

        body {
            font-family: 'Arial', sans-serif;
        }

        /* Header */
        .top-header {
            background: var(--light-bg);
            padding: 8px 0;
            font-size: 14px;
        }

        .main-header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: var(--primary-color);
        }

        .search-box {
            max-width: 500px;
        }

        .search-box .form-control {
            border-radius: 25px 0 0 25px;
            border-right: none;
        }

        .search-box .btn {
            border-radius: 0 25px 25px 0;
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .header-icons a {
            color: var(--dark-color);
            text-decoration: none;
            margin: 0 15px;
            position: relative;
        }

        .badge-count {
            position: absolute;
            top: -5px;
            right: -10px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Navigation */
        .main-nav {
            background: var(--secondary-color);
            padding: 0;
        }

        .category-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 15px 30px;
            font-weight: bold;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            display: inline-block;
            font-weight: 500;
            transition: all 0.3s;
        }

        .nav-links a:hover {
            background: rgba(255,255,255,0.2);
        }

        /* Hero Section */
        .hero-section {
            padding: 50px 0;
            background: linear-gradient(135deg, #f5f5f5 0%, #e8e8e8 100%);
        }

        .hero-card {
            background: url('https://images.unsplash.com/photo-1615486363906-6f88ded23e69?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80') center/cover no-repeat, linear-gradient(135deg, var(--primary-color), #ff8a65);
            background-blend-mode: overlay;
            border-radius: 20px;
            color: white;
            padding: 60px 40px;
            height: 400px;
            display: flex;
            align-items: center;
        }

        .hero-content h1 {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero-content p {
            font-size: 18px;
            opacity: 0.9;
            margin-bottom: 30px;
        }

        .btn-shop {
            background: white;
            color: var(--primary-color);
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: bold;
            border: none;
            font-size: 16px;
            transition: all 0.3s;
        }

        .btn-shop:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .promo-card {
            background: linear-gradient(135deg, var(--secondary-color), #e67e22);
            border-radius: 20px;
            color: white;
            padding: 40px 30px;
            height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .promo-card::before {
            content: '🌰';
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 60px;
            opacity: 0.3;
        }

        .discount-text {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        /* Products Section */
        .products-section {
            padding: 80px 0;
            background: white;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title h2 {
            font-size: 36px;
            font-weight: bold;
            color: var(--dark-color);
        }

        .section-title p {
            color: #666;
            font-size: 16px;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .product-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .product-card h4 {
            font-size: 18px;
            font-weight: bold;
            color: var(--dark-color);
        }

        .product-card p.price {
            color: #e74c3c;
            font-weight: bold;
            margin: 10px 0;
        }

        .product-card p.stock {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .product-card .btn-shop {
            background: var(--primary-color);
            color: white;
        }

        /* Features Section */
        .features-section {
            background: var(--light-bg);
            padding: 80px 0;
        }

        .feature-card {
            text-align: center;
            padding: 40px 20px;
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 24px;
        }

        /* Footer */
        .footer {
            background: var(--dark-color);
            color: white;
            padding: 60px 0 30px;
        }

        .footer h5 {
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .footer a {
            color: #bbb;
            text-decoration: none;
            display: block;
            padding: 5px 0;
        }

        .footer a:hover {
            color: var(--primary-color);
        }

        .social-links a {
            display: inline-block;
            margin-right: 15px;
            width: 40px;
            height: 40px;
            background: var(--primary-color);
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 28px;
            }

            .hero-content p {
                font-size: 14px;
            }

            .logo {
                font-size: 20px;
            }

            .search-box {
                margin: 20px 0;
            }

            .search-box .input-group {
                flex-direction: column;
            }

            .search-box .form-select,
            .search-box .form-control,
            .search-box .btn {
                border-radius: 25px !important;
                margin-bottom: 10px;
            }

            .header-icons {
                justify-content: center;
            }

            .product-card {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Top Header -->
    <div class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <small><i class="fas fa-phone"></i> +92 300 1234567 | <i class="fas fa-envelope"></i> info@awanglobal.com</small>
                </div>
                <div class="col-md-6 text-md-end">
                    <small>
                        <i class="fas fa-flag"></i> English 
                        <span class="mx-2">|</span> 
                        PKR <i class="fas fa-chevron-down ms-1"></i>
                        <span class="mx-2">|</span>
                        @guest
                            <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
                            <span class="mx-2">|</span>
                            <a href="{{ route('register') }}" class="text-decoration-none">Register</a>
                        @else
                            <span>{{ Auth::user()->name }}</span>
                            <span class="mx-2">|</span>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-decoration-none">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="main-header">
        <div class="container">
            <div class="row align-items-center py-3">
                <div class="col-lg-3 col-md-12 text-center text-lg-start mb-3 mb-lg-0">
                    <div class="logo">
                        <i class="fas fa-seedling me-2"></i>
                        Awan Global<br><small style="font-size: 14px; color: #666;">FOODS</small>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="search-box mx-auto">
                        <div class="input-group">
                            <select class="form-select" style="max-width: 150px; border-radius: 25px 0 0 25px;">
                                <option>ALL CATEGORIES</option>
                                <option value="1">Almonds</option>
                                <option value="2">Walnuts</option>
                                <option value="3">Cashews</option>
                                <option value="4">Pistachios</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Search for Products...">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="header-icons text-center text-lg-end">
                        <a href="#"><i class="fas fa-heart"></i><span class="badge-count">0</span></a>
                        <a href="#"><i class="fas fa-random"></i><span class="badge-count">0</span></a>
                        <a href="#"><i class="fas fa-shopping-cart"></i><span class="badge-count cart">0</span> PKR 0.00</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="main-nav">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <button class="category-btn w-100">
                        <i class="fas fa-bars me-2"></i> SHOP BY CATEGORY
                    </button>
                </div>
                <div class="col-lg-6">
                    <div class="nav-links">
                        <a href="#"><i class="fas fa-tag"></i> Special Prices</a>
                        <a href="#">Pages <i class="fas fa-chevron-down"></i></a>
                        <a href="#">Shop</a>
                        <a href="#">Stores</a>
                        <a href="#">Blog</a>
                        <a href="#">FAQs</a>
                        <a href="#">Contact</a>
                    </div>
                </div>
                <div class="col-lg-3 text-end">
                    <span class="text-white"><i class="fas fa-eye"></i> Recently Viewed</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="hero-card">
                        <div class="hero-content">
                            <h1>Premium Dry Fruits</h1>
                            <p>Fresh, high-quality almonds, walnuts, and more delivered to your doorstep</p>
                            <a href="#" class="btn-shop">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="promo-card">
                        <div class="discount-text">25% OFF</div>
                        <h4>Premium Almonds</h4>
                        <p>California Almonds<br>Net 1 KG</p>
                        <a href="#" class="btn btn-light mt-3">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="products-section">
        <div class="container">
            <div class="section-title">
                <h2>Our Premium Products</h2>
                <p>Discover our high-quality dry fruits and more</p>
            </div>
            <div class="row">
                <!-- Product 1 -->
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1615486363906-6f88ded23e69?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Almonds" loading="lazy">
                        <h4>Premium Almonds</h4>
                        <p class="price">PKR 1200</p>
                        <p class="stock"><span class="text-success">In Stock (50)</span></p>
                        <button class="btn btn-shop" onclick="addToCart(1)">Add to Cart</button>
                    </div>
                </div>
                <!-- Product 2 -->
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1596394514500-7d7b7e3e3e1e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Walnuts" loading="lazy">
                        <h4>Whole Walnuts</h4>
                        <p class="price">PKR 1500</p>
                        <p class="stock"><span class="text-success">In Stock (30)</span></p>
                        <button class="btn btn-shop" onclick="addToCart(2)">Add to Cart</button>
                    </div>
                </div>
                <!-- Product 3 -->
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1606913084603-3e7702b01627?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Cashews" loading="lazy">
                        <h4>Roasted Cashews</h4>
                        <p class="price">PKR 1400</p>
                        <p class="stock"><span class="text-danger">Out of Stock</span></p>
                        <button class="btn btn-shop" disabled>Add to Cart</button>
                    </div>
                </div>
                <!-- Product 4 -->
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1571683171925-3d8b3d6f0b0f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Pistachios" loading="lazy">
                        <h4>Pistachios</h4>
                        <p class="price">PKR 1800</p>
                        <p class="stock"><span class="text-success">In Stock (20)</span></p>
                        <button class="btn btn-shop" onclick="addToCart(4)">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <h5>Free Shipping</h5>
                        <p>Free shipping on orders over PKR 2000</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-medal"></i>
                        </div>
                        <h5>Premium Quality</h5>
                        <p>100% authentic and premium products</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h5>24/7 Support</h5>
                        <p>Dedicated customer support team</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-undo"></i>
                        </div>
                        <h5>Easy Returns</h5>
                        <p>30-day return policy</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Awan Global Foods</h5>
                    <p>Your trusted partner for premium quality dry fruits across Pakistan.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Quick Links</h5>
                    <a href="#">About Us</a>
                    <a href="#">Contact Us</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms & Conditions</a>
                    <a href="#">Wholesale Inquiry</a>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Categories</h5>
                    <a href="#">Almonds</a>
                    <a href="#">Walnuts</a>
                    <a href="#">Cashews</a>
                    <a href="#">Pistachios</a>
                    <a href="#">Dried Fruits</a>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Contact Info</h5>
                    <p><i class="fas fa-map-marker-alt me-2"></i> Islamabad, Pakistan</p>
                    <p><i class="fas fa-phone me-2"></i> +92 300 1234567</p>
                    <p><i class="fas fa-envelope me-2"></i> info@awanglobal.com</p>
                    <p><i class="fas fa-clock me-2"></i> Mon-Fri: 9AM-6PM</p>
                </div>
            </div>
            <hr style="border-color: #444; margin: 40px 0 20px;">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2024 Awan Global Foods. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>Designed with ❤️ for premium food experience</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        let cartCount = 0;

        // Add to Cart
        function addToCart(productId) {
            cartCount++;
            document.querySelector('.badge-count.cart').textContent = cartCount;
            alert(`Product ${productId} added to cart! Total items: ${cartCount}`);
        }

        // Animate cards on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.product-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease';
                observer.observe(card);
            });
        });
    </script>
</body>
</html>