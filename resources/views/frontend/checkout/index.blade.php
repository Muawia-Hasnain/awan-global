@extends('frontend.layouts.app')

@section('title', 'Checkout - Awan Global Foods')

@section('content')

@php
    // 🔹 Dummy cart items (replace with real data from your controller)
    $cartItems = [
        (object)[
            'id' => 1,
            'product_name' => 'Fresh Basmati Rice',
            'product_image' => 'https://via.placeholder.com/60x60/16a34a/ffffff?text=Rice',
            'price' => 250,
            'quantity' => 2,
            'total' => 500
        ],
        (object)[
            'id' => 2,
            'product_name' => 'Organic Tomatoes',
            'product_image' => 'https://via.placeholder.com/60x60/ef4444/ffffff?text=🍅',
            'price' => 80,
            'quantity' => 3,
            'total' => 240
        ],
        (object)[
            'id' => 3,
            'product_name' => 'Premium Cooking Oil',
            'product_image' => 'https://via.placeholder.com/60x60/f59e0b/ffffff?text=Oil',
            'price' => 450,
            'quantity' => 1,
            'total' => 450
        ]
    ];

    // 🔹 User addresses (dummy data)
    $savedAddresses = [
        (object)[
            'id' => 1,
            'title' => 'Home',
            'name' => 'John Doe',
            'phone' => '+92 300 1234567',
            'address' => '123 Main Street, Block A, DHA Phase 2',
            'city' => 'Islamabad',
            'postal_code' => '44000',
            'is_default' => true
        ],
        (object)[
            'id' => 2,
            'title' => 'Office',
            'name' => 'John Doe',
            'phone' => '+92 301 7654321',
            'address' => '456 Business Center, Blue Area',
            'city' => 'Islamabad',
            'postal_code' => '44000',
            'is_default' => false
        ]
    ];

    $cartTotal = collect($cartItems)->sum('total');
    $cartCount = collect($cartItems)->sum('quantity');
    $deliveryFee = $cartTotal > 1000 ? 0 : 100;
    $grandTotal = $cartTotal + $deliveryFee;
    $user = Auth::user() ?? (object)['name' => 'John Doe', 'email' => 'john@example.com', 'phone' => '+92 300 1234567'];
@endphp

<style>
.checkout-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

.checkout-header {
    text-align: center;
    margin-bottom: 2rem;
}

.checkout-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: #111827;
    margin-bottom: 0.5rem;
}

.checkout-subtitle {
    color: #6b7280;
    font-size: 1.1rem;
}

.progress-bar {
    display: flex;
    justify-content: center;
    margin: 2rem 0;
    gap: 2rem;
}

.progress-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
}

.step-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e5e7eb;
    color: #6b7280;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-bottom: 0.5rem;
    transition: all 0.3s;
}

.step-circle.active {
    background: #16a34a;
    color: white;
}

.step-circle.completed {
    background: #16a34a;
    color: white;
}

.step-label {
    font-size: 0.875rem;
    color: #6b7280;
    font-weight: 500;
}

.step-label.active {
    color: #16a34a;
    font-weight: 600;
}

.progress-line {
    position: absolute;
    top: 20px;
    left: 50%;
    width: 100px;
    height: 2px;
    background: #e5e7eb;
    z-index: -1;
}

.progress-line.completed {
    background: #16a34a;
}

.checkout-main {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
    align-items: start;
}

.checkout-form {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    border: 1px solid #e5e7eb;
}

.section-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #111827;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.section {
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid #f3f4f6;
}

.section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.address-cards {
    display: grid;
    gap: 1rem;
    margin-bottom: 1rem;
}

.address-card {
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    padding: 1rem;
    cursor: pointer;
    transition: all 0.2s;
    position: relative;
}

.address-card:hover {
    border-color: #16a34a;
}

.address-card.selected {
    border-color: #16a34a;
    background: #f0fdf4;
}

.address-card input[type="radio"] {
    position: absolute;
    top: 1rem;
    right: 1rem;
}

.address-title {
    font-weight: 600;
    color: #111827;
    margin-bottom: 0.25rem;
}

.address-details {
    color: #6b7280;
    line-height: 1.5;
}

.default-badge {
    background: #16a34a;
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
    margin-left: 0.5rem;
}

.add-address-btn {
    border: 2px dashed #d1d5db;
    background: none;
    padding: 1rem;
    border-radius: 8px;
    color: #6b7280;
    cursor: pointer;
    transition: all 0.2s;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.add-address-btn:hover {
    border-color: #16a34a;
    color: #16a34a;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1rem;
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.5rem;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 1rem;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #16a34a;
    box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
}

.payment-methods {
    display: grid;
    gap: 1rem;
}

.payment-card {
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    padding: 1rem;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.payment-card:hover {
    border-color: #16a34a;
}

.payment-card.selected {
    border-color: #16a34a;
    background: #f0fdf4;
}

.payment-icon {
    font-size: 2rem;
}

.payment-details {
    flex: 1;
}

.payment-title {
    font-weight: 600;
    color: #111827;
    margin-bottom: 0.25rem;
}

.payment-subtitle {
    color: #6b7280;
    font-size: 0.875rem;
}

.order-summary {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    border: 1px solid #e5e7eb;
    height: fit-content;
    position: sticky;
    top: 2rem;
}

.summary-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #111827;
    margin-bottom: 1rem;
    text-align: center;
}

.order-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f3f4f6;
}

.order-item:last-child {
    border-bottom: none;
}

.item-image {
    width: 50px;
    height: 50px;
    border-radius: 6px;
    object-fit: cover;
}

.item-info {
    flex: 1;
}

.item-name {
    font-weight: 500;
    color: #111827;
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.item-quantity {
    color: #6b7280;
    font-size: 0.75rem;
}

.item-price {
    font-weight: 600;
    color: #111827;
    font-size: 0.875rem;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f3f4f6;
}

.summary-row:last-child {
    border-bottom: none;
    font-weight: bold;
    font-size: 1.1rem;
    color: #111827;
    margin-top: 0.5rem;
    padding-top: 1rem;
    border-top: 2px solid #f3f4f6;
}

.place-order-btn {
    width: 100%;
    background: linear-gradient(135deg, #16a34a, #22c55e);
    color: white;
    padding: 1rem;
    border: none;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s;
    margin-top: 1.5rem;
}

.place-order-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(22, 163, 74, 0.3);
}

.secure-checkout {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 1rem;
    color: #6b7280;
    font-size: 0.875rem;
}

.terms-checkbox {
    display: flex;
    align-items: start;
    gap: 0.5rem;
    margin-top: 1rem;
    padding: 1rem;
    background: #f9fafb;
    border-radius: 6px;
}

.terms-checkbox input[type="checkbox"] {
    margin-top: 0.25rem;
}

.terms-text {
    font-size: 0.875rem;
    color: #374151;
    line-height: 1.5;
}

.terms-text a {
    color: #16a34a;
    font-weight: 500;
}

.back-to-cart {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #16a34a;
    text-decoration: none;
    font-weight: 500;
    margin-bottom: 1rem;
    transition: color 0.2s;
}

.back-to-cart:hover {
    color: #15803d;
    text-decoration: none;
}

@media (max-width: 768px) {
    .checkout-main {
        grid-template-columns: 1fr;
    }
    
    .progress-bar {
        gap: 1rem;
    }
    
    .progress-line {
        width: 60px;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .checkout-form {
        padding: 1rem;
    }
}
</style>

<div class="checkout-container">
    <!-- Checkout Header -->
    <div class="checkout-header">
        <h1 class="checkout-title">🛒 Secure Checkout</h1>
        <p class="checkout-subtitle">Complete your order in a few simple steps</p>
    </div>

    <!-- Progress Bar -->
    <div class="progress-bar">
        <div class="progress-step">
            <div class="step-circle completed">✓</div>
            <span class="step-label">Cart</span>
        </div>
        <div class="progress-line completed"></div>
        <div class="progress-step">
            <div class="step-circle active">2</div>
            <span class="step-label active">Checkout</span>
        </div>
        <div class="progress-line"></div>
        <div class="progress-step">
            <div class="step-circle">3</div>
            <span class="step-label">Payment</span>
        </div>
        <div class="progress-line"></div>
        <div class="progress-step">
            <div class="step-circle">4</div>
            <span class="step-label">Complete</span>
        </div>
    </div>

    <!-- Back to Cart -->
    <a href="{{ route('cart.index') }}" class="back-to-cart">
        ← Back to Cart
    </a>

    <div class="checkout-main">
        <!-- Checkout Form -->
        <form id="checkout-form" method="POST" action="{{ route('checkout.process') ?? '#' }}" class="checkout-form">
            @csrf
            
            <!-- Delivery Address Section -->
            <div class="section">
                <h2 class="section-title">
                    📍 Delivery Address
                </h2>
                
                <div class="address-cards">
                    @foreach($savedAddresses as $address)
                        <label class="address-card {{ $address->is_default ? 'selected' : '' }}">
                            <input type="radio" name="address_id" value="{{ $address->id }}" 
                                   {{ $address->is_default ? 'checked' : '' }}>
                            <div class="address-title">
                                {{ $address->title }}
                                @if($address->is_default)
                                    <span class="default-badge">Default</span>
                                @endif
                            </div>
                            <div class="address-details">
                                <strong>{{ $address->name }}</strong><br>
                                {{ $address->address }}<br>
                                {{ $address->city }}, {{ $address->postal_code }}<br>
                                📞 {{ $address->phone }}
                            </div>
                        </label>
                    @endforeach
                    
                    <button type="button" class="add-address-btn" onclick="toggleNewAddressForm()">
                        ➕ Add New Address
                    </button>
                </div>

                <!-- New Address Form (Hidden by default) -->
                <div id="new-address-form" style="display: none; margin-top: 1rem; padding: 1rem; background: #f9fafb; border-radius: 8px;">
                    <h3 style="margin-bottom: 1rem; color: #111827;">Add New Address</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Address Title *</label>
                            <input type="text" name="new_address_title" placeholder="e.g., Home, Office">
                        </div>
                        <div class="form-group">
                            <label>Full Name *</label>
                            <input type="text" name="new_address_name" value="{{ $user->name }}">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Complete Address *</label>
                        <textarea name="new_address_address" rows="2" placeholder="House/Flat no, Street, Area"></textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>City *</label>
                            <input type="text" name="new_address_city" value="Islamabad">
                        </div>
                        <div class="form-group">
                            <label>Postal Code *</label>
                            <input type="text" name="new_address_postal_code" placeholder="44000">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Phone Number *</label>
                        <input type="tel" name="new_address_phone" value="{{ $user->phone ?? '' }}">
                    </div>
                </div>
            </div>

            <!-- Delivery Options Section -->
            <div class="section">
                <h2 class="section-title">
                    🚚 Delivery Options
                </h2>
                
                <div class="payment-methods">
                    <label class="payment-card selected">
                        <input type="radio" name="delivery_option" value="standard" checked style="display: none;">
                        <div class="payment-icon">🚚</div>
                        <div class="payment-details">
                            <div class="payment-title">Standard Delivery</div>
                            <div class="payment-subtitle">2-3 business days • {{ $deliveryFee == 0 ? 'FREE' : '₹' . $deliveryFee }}</div>
                        </div>
                    </label>
                    
                    <label class="payment-card">
                        <input type="radio" name="delivery_option" value="express" style="display: none;">
                        <div class="payment-icon">⚡</div>
                        <div class="payment-details">
                            <div class="payment-title">Express Delivery</div>
                            <div class="payment-subtitle">Next business day • ₹200</div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Payment Method Section -->
            <div class="section">
                <h2 class="section-title">
                    💳 Payment Method
                </h2>
                
                <div class="payment-methods">
                    <label class="payment-card selected">
                        <input type="radio" name="payment_method" value="cod" checked style="display: none;">
                        <div class="payment-icon">💵</div>
                        <div class="payment-details">
                            <div class="payment-title">Cash on Delivery</div>
                            <div class="payment-subtitle">Pay when your order arrives</div>
                        </div>
                    </label>
                    
                    <label class="payment-card">
                        <input type="radio" name="payment_method" value="card" style="display: none;">
                        <div class="payment-icon">💳</div>
                        <div class="payment-details">
                            <div class="payment-title">Credit/Debit Card</div>
                            <div class="payment-subtitle">Visa, MasterCard, etc.</div>
                        </div>
                    </label>
                    
                    <label class="payment-card">
                        <input type="radio" name="payment_method" value="jazzcash" style="display: none;">
                        <div class="payment-icon">📱</div>
                        <div class="payment-details">
                            <div class="payment-title">JazzCash</div>
                            <div class="payment-subtitle">Mobile wallet payment</div>
                        </div>
                    </label>
                    
                    <label class="payment-card">
                        <input type="radio" name="payment_method" value="easypaisa" style="display: none;">
                        <div class="payment-icon">💰</div>
                        <div class="payment-details">
                            <div class="payment-title">EasyPaisa</div>
                            <div class="payment-subtitle">Mobile wallet payment</div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Order Notes -->
            <div class="section">
                <h2 class="section-title">
                    📝 Order Notes (Optional)
                </h2>
                <div class="form-group">
                    <textarea name="order_notes" rows="3" placeholder="Any special instructions for your order..."></textarea>
                </div>
            </div>

            <!-- Terms and Conditions -->
            <div class="terms-checkbox">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms" class="terms-text">
                    I agree to the <a href="#" target="_blank">Terms & Conditions</a> and <a href="#" target="_blank">Privacy Policy</a>. 
                    I understand that my order will be processed according to the selected delivery option.
                </label>
            </div>
        </form>

        <!-- Order Summary -->
        <div class="order-summary">
            <h2 class="summary-title">📋 Order Summary</h2>
            
            <!-- Order Items -->
            <div style="margin-bottom: 1rem;">
                @foreach($cartItems as $item)
                    <div class="order-item">
                        <img src="{{ $item->product_image }}" alt="{{ $item->product_name }}" class="item-image">
                        <div class="item-info">
                            <div class="item-name">{{ $item->product_name }}</div>
                            <div class="item-quantity">Qty: {{ $item->quantity }}</div>
                        </div>
                        <div class="item-price">₹{{ number_format($item->total) }}</div>
                    </div>
                @endforeach
            </div>
            
            <!-- Price Breakdown -->
            <div class="summary-row">
                <span>Subtotal ({{ $cartCount }} items)</span>
                <span>₹{{ number_format($cartTotal) }}</span>
            </div>
            
            <div class="summary-row">
                <span>Delivery Fee</span>
                <span id="delivery-cost">
                    @if($deliveryFee == 0)
                        <span style="color: #16a34a;">FREE</span>
                    @else
                        ₹{{ number_format($deliveryFee) }}
                    @endif
                </span>
            </div>
            
            <div class="summary-row">
                <span>Total</span>
                <span id="grand-total">₹{{ number_format($grandTotal) }}</span>
            </div>
            
            <!-- Place Order Button -->
            <button type="submit" form="checkout-form" class="place-order-btn" id="place-order-btn">
                🛒 Place Order - ₹{{ number_format($grandTotal) }}
            </button>
            
            <div class="secure-checkout">
                🔒 Secure Checkout • Your data is safe
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Address selection
    const addressCards = document.querySelectorAll('.address-card');
    addressCards.forEach(card => {
        card.addEventListener('click', function() {
            addressCards.forEach(c => c.classList.remove('selected'));
            this.classList.add('selected');
            this.querySelector('input[type="radio"]').checked = true;
        });
    });

    // Payment method selection
    const paymentCards = document.querySelectorAll('.payment-card');
    paymentCards.forEach(card => {
        card.addEventListener('click', function() {
            paymentCards.forEach(c => c.classList.remove('selected'));
            this.classList.add('selected');
            this.querySelector('input[type="radio"]').checked = true;
        });
    });

    // Delivery option change
    const deliveryOptions = document.querySelectorAll('input[name="delivery_option"]');
    deliveryOptions.forEach(option => {
        option.addEventListener('change', function() {
            updateDeliveryCost();
        });
    });

    // Form validation
    const form = document.getElementById('checkout-form');
    const placeOrderBtn = document.getElementById('place-order-btn');
    
    form.addEventListener('submit', function(e) {
        const termsCheckbox = document.getElementById('terms');
        if (!termsCheckbox.checked) {
            e.preventDefault();
            alert('Please agree to the Terms & Conditions to continue.');
            return;
        }

        // Show loading state
        placeOrderBtn.innerHTML = '⏳ Processing Order...';
        placeOrderBtn.disabled = true;
    });
});

// Toggle new address form
function toggleNewAddressForm() {
    const form = document.getElementById('new-address-form');
    const isVisible = form.style.display !== 'none';
    form.style.display = isVisible ? 'none' : 'block';
    
    if (!isVisible) {
        form.scrollIntoView({ behavior: 'smooth' });
    }
}

// Update delivery cost based on selected option
function updateDeliveryCost() {
    const selectedDelivery = document.querySelector('input[name="delivery_option"]:checked').value;
    const deliveryCostElement = document.getElementById('delivery-cost');
    const grandTotalElement = document.getElementById('grand-total');
    const placeOrderBtn = document.getElementById('place-order-btn');
    
    const subtotal = {{ $cartTotal }};
    let deliveryCost = 0;
    
    if (selectedDelivery === 'express') {
        deliveryCost = 200;
    } else {
        deliveryCost = subtotal > 1000 ? 0 : 100;
    }
    
    const grandTotal = subtotal + deliveryCost;
    
    if (deliveryCost === 0) {
        deliveryCostElement.innerHTML = '<span style="color: #16a34a;">FREE</span>';
    } else {
        deliveryCostElement.textContent = `₹${deliveryCost.toLocaleString()}`;
    }
    
    grandTotalElement.textContent = `₹${grandTotal.toLocaleString()}`;
    placeOrderBtn.innerHTML = `🛒 Place Order - ₹${grandTotal.toLocaleString()}`;
}

// Smooth scroll for back to cart
document.querySelector('.back-to-cart').addEventListener('click', function(e) {
    e.preventDefault();
    window.history.back();
});
</script>

@endsection