<style>
.header {
    background: #fff;
    border-bottom: 1px solid #e5e7eb;
    padding: 1rem 0;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

.nav-brand {
    font-size: 1.5rem;
    font-weight: bold;
    color: #16a34a;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.nav-brand:hover {
    color: #15803d;
    text-decoration: none;
}

.nav-links {
    display: flex;
    gap: 2rem;
    list-style: none;
    margin: 0;
    padding: 0;
}

.nav-links a {
    text-decoration: none;
    color: #374151;
    font-weight: 500;
    transition: color 0.2s;
    position: relative;
}

.nav-links a:hover {
    color: #16a34a;
    text-decoration: none;
}

.nav-links a::after {
    content: '';
    position: absolute;
    bottom: -4px;
    left: 0;
    width: 0;
    height: 2px;
    background: #16a34a;
    transition: width 0.2s;
}

.nav-links a:hover::after {
    width: 100%;
}

.user-menu {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.user-avatar {
    width: 40px;
    height: 40px;
    background: #16a34a;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 0.9rem;
}

.cart-icon {
    position: relative;
    color: #374151;
    text-decoration: none;
    font-size: 1.2rem;
    padding: 0.5rem;
    transition: color 0.2s;
}

.cart-icon:hover {
    color: #16a34a;
    text-decoration: none;
}

.cart-badge {
    position: absolute;
    top: 0;
    right: 0;
    background: #ef4444;
    color: white;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    font-size: 0.7rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.auth-links {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.auth-links a {
    color: #374151;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
}

.auth-links a:hover {
    color: #16a34a;
    text-decoration: none;
}

.logout-btn {
    background: none;
    border: none;
    color: #374151;
    font-weight: 500;
    cursor: pointer;
    transition: color 0.2s;
    font-family: inherit;
}

.logout-btn:hover {
    color: #ef4444;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    top: 100%;
    background-color: white;
    min-width: 200px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    border-radius: 8px;
    padding: 0.5rem 0;
    border: 1px solid #e5e7eb;
    z-index: 1000;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown-content a {
    color: #374151;
    padding: 0.75rem 1rem;
    text-decoration: none;
    display: block;
    transition: background 0.2s;
}

.dropdown-content a:hover {
    background-color: #f9fafb;
    color: #16a34a;
}

.mobile-menu-btn {
    display: none;
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: #374151;
}

@media (max-width: 768px) {
    .nav-links {
        display: none;
    }
    
    .mobile-menu-btn {
        display: block;
    }
    
    .user-menu {
        gap: 0.5rem;
    }
    
    .nav-brand {
        font-size: 1.25rem;
    }
}
</style>

<header class="header">
    <nav class="nav">
        <!-- Brand Logo -->
        <div class="flex items-center">
            <a href="{{ route('home') }}" class="nav-brand">
                🛒 Awan Global Foods
            </a>
        </div>

        <!-- Navigation Links -->
        <ul class="nav-links">
            <li><a href="{{ route('products.index') }}">Products</a></li>
            <li><a href="{{ route('pages.about') }}">About</a></li> 
            <li><a href="{{ route('pages.contact') }}">Contact</a></li>
        </ul>

        <!-- User Menu -->
        <div class="user-menu">
            <!-- Cart Icon -->
            <a href="{{ route('cart.index') }}" class="cart-icon">
                🛒
                {{-- You can add cart count here --}}
                {{-- <span class="cart-badge">3</span> --}}
            </a>

            @auth
                <!-- Authenticated User Dropdown -->
                <div class="dropdown">
                    <div class="user-avatar">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="dropdown-content">
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('customer.dashboard') }}">
                            {{ auth()->user()->role === 'admin' ? '🔧 Admin Panel' : '👤 My Account' }}
                        </a>
                        <a href="#">📦 My Orders</a>
                        <a href="#">❤️ Wishlist</a>
                        <a href="#">⚙️ Settings</a>
                        <hr style="margin: 0.5rem 0; border: none; border-top: 1px solid #e5e7eb;">
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="logout-btn" style="width: 100%; text-align: left; padding: 0.75rem 1rem;">
                                🚪 Logout
                            </button>
                        </form>
                    </div>
                </div>
                
                <span style="color: #6b7280; font-size: 0.9rem;">
                    Hi, {{ auth()->user()->name }}!
                </span>
            @else
                <!-- Guest User Links -->
                <div class="auth-links">
                    <a href="{{ route('login') }}">Login</a>
                    <span style="color: #d1d5db;">|</span>
                    <a href="{{ route('register') ?? '#' }}">Register</a>
                </div>
            @endauth

            <!-- Mobile Menu Button -->
            <button class="mobile-menu-btn">☰</button>
        </div>
    </nav>
</header>

{{-- Optional: Add mobile menu JavaScript --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');
    
    if (mobileMenuBtn && navLinks) {
        mobileMenuBtn.addEventListener('click', function() {
            navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
            if (navLinks.style.display === 'flex') {
                navLinks.style.flexDirection = 'column';
                navLinks.style.position = 'absolute';
                navLinks.style.top = '100%';
                navLinks.style.left = '0';
                navLinks.style.right = '0';
                navLinks.style.background = 'white';
                navLinks.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
                navLinks.style.padding = '1rem';
                navLinks.style.borderTop = '1px solid #e5e7eb';
            }
        });
    }
});
</script>