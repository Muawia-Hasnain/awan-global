@extends('frontend.layouts.app')

@section('title', 'My Dashboard - Awan Global Foods')

@section('content')
    <style>
        * { box-sizing: border-box; }
        .main-content { padding: 2rem 0; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1rem; }
        .welcome-section { background: linear-gradient(135deg, #16a34a, #22c55e); color: #fff; padding: 2rem; border-radius: 12px; margin-bottom: 2rem; }
        .welcome-title { font-size: 2rem; margin-bottom: .5rem; }
        .welcome-subtitle { opacity: .9; font-size: 1.1rem; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .stat-card { background: #fff; padding: 1.5rem; border-radius: 12px; border: 1px solid #e5e7eb; transition: transform .2s, box-shadow .2s; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(0,0,0,.1); }
        .stat-number { font-size: 2.5rem; font-weight: 700; color: #16a34a; margin-bottom: .5rem; }
        .stat-label { color: #6b7280; font-weight: 500; }
        .quick-actions { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem; }
        .action-btn { background: #fff; border: 1px solid #e5e7eb; padding: 1.5rem; border-radius: 12px; text-decoration: none; color: #374151; text-align: center; transition: all .2s; display: flex; flex-direction: column; align-items: center; gap: .5rem; }
        .action-btn:hover { border-color: #16a34a; color: #16a34a; transform: translateY(-2px); }
        .action-icon { width: 40px; height: 40px; background: #f3f4f6; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
        .recent-section { display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; }
        .recent-orders, .account-info { background: #fff; padding: 1.5rem; border-radius: 12px; border: 1px solid #e5e7eb; }
        .section-title { font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem; color: #111827; }
        .order-item { display: flex; justify-content: space-between; align-items: center; padding: 1rem 0; border-bottom: 1px solid #f3f4f6; }
        .order-item:last-child { border-bottom: none; }
        .order-id { font-weight: 600; color: #374151; }
        .order-status { padding: .25rem .75rem; border-radius: 20px; font-size: .875rem; font-weight: 500; }
        .status-delivered { background: #dcfce7; color: #166534; }
        .status-pending { background: #fef3c7; color: #92400e; }
        .info-item { display: flex; justify-content: space-between; padding: .75rem 0; border-bottom: 1px solid #f3f4f6; }
        .info-item:last-child { border-bottom: none; }
        @media (max-width: 768px) { .recent-section { grid-template-columns: 1fr; } .stats-grid { grid-template-columns: 1fr 1fr; } .quick-actions { grid-template-columns: repeat(2, 1fr); } }
    </style>

    <main class="main-content">
        <div class="container">
            <section class="welcome-section">
                <h1 class="welcome-title">Welcome back, {{ auth()->user()->name ?? 'Customer' }}! 👋</h1>
                <p class="welcome-subtitle">Ready to discover fresh groceries and amazing deals?</p>
            </section>

            <section class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">0</div>
                    <div class="stat-label">Total Orders</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">0</div>
                    <div class="stat-label">Active Orders</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">0</div>
                    <div class="stat-label">Wishlist Items</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">Rs. 0</div>
                    <div class="stat-label">Total Spent</div>
                </div>
            </section>

            <section class="quick-actions">
                <a href="{{ route('products.index') }}" class="action-btn">
                    <div class="action-icon">🛍️</div>
                    <span>Shop Now</span>
                </a>
                <a href="{{ route('customer.orders.index') }}" class="action-btn">
                    <div class="action-icon">📦</div>
                    <span>Track Orders</span>
                </a>
                <a href="{{ route('customer.addresses.index') }}" class="action-btn">
                    <div class="action-icon">📍</div>
                    <span>Addresses</span>
                </a>
                <a href="{{ route('customer.profile') }}" class="action-btn">
                    <div class="action-icon">👤</div>
                    <span>My Profile</span>
                </a>
                <a href="{{ route('deals.index') }}" class="action-btn">
                    <div class="action-icon">🔥</div>
                    <span>Hot Deals</span>
                </a>
                <a href="{{ route('customer.wishlist.index') }}" class="action-btn">
                    <div class="action-icon">❤️</div>
                    <span>Wishlist</span>
                </a>
            </section>

            <section class="recent-section">
                <div class="recent-orders">
                    <h2 class="section-title">Recent Orders</h2>
                    <p style="color:#6b7280;">No recent orders yet.</p>
                    <div style="margin-top: 1rem; text-align: center;">
                        <a href="{{ route('customer.orders.index') }}" style="color: #16a34a; text-decoration: none; font-weight: 500;">View All Orders →</a>
                    </div>
                </div>

                <div class="account-info">
                    <h2 class="section-title">Account Info</h2>
                    <div class="info-item">
                        <span>Email</span>
                        <span>{{ auth()->user()->email ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span>Member Since</span>
                        <span>{{ optional(auth()->user()->created_at)->format('M Y') }}</span>
                    </div>
                    <div class="info-item">
                        <span>Saved Addresses</span>
                        <span>0</span>
                    </div>
                    <div style="margin-top: 1rem; text-align: center;">
                        <a href="{{ route('customer.profile') }}" style="color: #16a34a; text-decoration: none; font-weight: 500;">Edit Profile →</a>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection 