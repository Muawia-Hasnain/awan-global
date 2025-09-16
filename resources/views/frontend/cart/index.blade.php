@extends('frontend.layouts.app')

@section('title', 'Your Cart - Awan Global Foods')

@section('content')

@php
    // 🔹 Dummy cart items (replace with real data from your controller)
    $cartItems = [
        (object)[
            'id' => 1,
            'product_name' => 'Fresh Basmati Rice',
            'product_image' => 'https://via.placeholder.com/80x80/16a34a/ffffff?text=Rice',
            'price' => 250,
            'quantity' => 2,
            'total' => 500,
            'stock' => 10
        ],
        (object)[
            'id' => 2,
            'product_name' => 'Organic Tomatoes',
            'product_image' => 'https://via.placeholder.com/80x80/ef4444/ffffff?text=🍅',
            'price' => 80,
            'quantity' => 3,
            'total' => 240,
            'stock' => 5
        ],
        (object)[
            'id' => 3,
            'product_name' => 'Premium Cooking Oil',
            'product_image' => 'https://via.placeholder.com/80x80/f59e0b/ffffff?text=Oil',
            'price' => 450,
            'quantity' => 1,
            'total' => 450,
            'stock' => 15
        ]
    ];

    $cartTotal = collect($cartItems)->sum('total');
    $cartCount = collect($cartItems)->sum('quantity');
    $deliveryFee = $cartTotal > 1000 ? 0 : 100;
    $grandTotal = $cartTotal + $deliveryFee;
@endphp

<style>
.cart-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

.cart-header {
    text-align: center;
    margin-bottom: 2rem;
}

.cart-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: #111827;
    margin-bottom: 0.5rem;
}

.cart-subtitle {
    color: #6b7280;
    font-size: 1.1rem;
}

.cart-main {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
    align-items: start;
}

.cart-items-section {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    border: 1px solid #e5e7eb;
}

.cart-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.5rem 0;
    border-bottom: 1px solid #f3f4f6;
    transition: background 0.2s;
}

.cart-item:last-child {
    border-bottom: none;
}

.cart-item:hover {
    background: #f9fafb;
    border-radius: 8px;
    margin: 0 -0.5rem;
    padding-left: 2rem;
    padding-right: 2rem;
}

.item-image {
    width: 80px;
    height: 80px;
    border-radius: 8px;
    object-fit: cover;
    border: 1px solid #e5e7eb;
}

.item-details {
    flex: 1;
}

.item-name {
    font-size: 1.1rem;
    font-weight: 600;
    color: #111827;
    margin-bottom: 0.25rem;
}

.item-price {
    color: #16a34a;
    font-weight: 600;
    font-size: 1rem;
}

.quantity-controls {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 0.5rem;
}

.qty-btn {
    width: 32px;
    height: 32px;
    border: 1px solid #d1d5db;
    background: white;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
    font-weight: bold;
}

.qty-btn:hover {
    border-color: #16a34a;
    color: #16a34a;
}

.qty-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.qty-input {
    width: 50px;
    text-align: center;
    border: 1px solid #d1d5db;
    padding: 0.5rem;
    border-radius: 6px;
}

.item-total {
    font-size: 1.25rem;
    font-weight: bold;
    color: #111827;
    text-align: center;
    min-width: 100px;
}

.remove-btn {
    color: #ef4444;
    background: none;
    border: none;
    padding: 0.5rem;
    border-radius: 50%;
    cursor: pointer;
    transition: background 0.2s;
    font-size: 1.2rem;
}

.remove-btn:hover {
    background: #fee2e2;
}

.cart-summary {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    border: 1px solid #e5e7eb;
    height: fit-content;
    sticky: true;
    top: 2rem;
}

.summary-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #111827;
    margin-bottom: 1rem;
    text-align: center;
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
}

.checkout-btn {
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
    margin-top: 1rem;
}

.checkout-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(22, 163, 74, 0.3);
}

.continue-shopping {
    display: block;
    text-align: center;
    color: #16a34a;
    text-decoration: none;
    margin-top: 1rem;
    font-weight: 500;
    transition: color 0.2s;
}

.continue-shopping:hover {
    color: #15803d;
    text-decoration: none;
}

.empty-cart {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.empty-cart-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

.empty-cart-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #111827;
    margin-bottom: 0.5rem;
}

.empty-cart-subtitle {
    color: #6b7280;
    margin-bottom: 2rem;
}

.promo-section {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 8px;
    padding: 1rem;
    margin: 1rem 0;
}

.promo-input {
    display: flex;
    gap: 0.5rem;
}

.promo-input input {
    flex: 1;
    padding: 0.5rem;
    border: 1px solid #d1d5db;
    border-radius: 6px;
}

.apply-btn {
    background: #16a34a;
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
}

/* Login Modal Styles */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    display: none;
    z-index: 1000;
    animation: fadeIn 0.3s ease;
}

.modal-content {
    max-width: 480px;
    margin: 10% auto;
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    animation: slideIn 0.3s ease;
}

.modal-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #111827;
    margin-bottom: 1rem;
    text-align: center;
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

.form-group input {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 1rem;
    transition: border-color 0.2s;
}

.form-group input:focus {
    outline: none;
    border-color: #16a34a;
    box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
}

.modal-actions {
    display: flex;
    gap: 0.75rem;
    justify-content: flex-end;
    margin-top: 1.5rem;
}

.btn-secondary {
    padding: 0.75rem 1.5rem;
    border: 1px solid #d1d5db;
    background: white;
    color: #374151;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    transition: background 0.2s;
}

.btn-secondary:hover {
    background: #f9fafb;
}

.btn-primary {
    padding: 0.75rem 1.5rem;
    background: #16a34a;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    transition: background 0.2s;
}

.btn-primary:hover {
    background: #15803d;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideIn {
    from { transform: translateY(-50px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

@media (max-width: 768px) {
    .cart-main {
        grid-template-columns: 1fr;
    }
    
    .cart-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .item-details {
        width: 100%;
    }
    
    .quantity-controls {
        justify-content: center;
        width: 100%;
    }
    
    .item-total {
        text-align: left;
    }
}
</style>

<div class="cart-container">
    <!-- Cart Header -->
    <div class="cart-header">
        <h1 class="cart-title">🛒 Your Shopping Cart</h1>
        <p class="cart-subtitle">
            @if(count($cartItems) > 0)
                You have {{ $cartCount }} {{ Str::plural('item', $cartCount) }} in your cart
            @else
                Your cart is currently empty
            @endif
        </p>
    </div>

    @if(count($cartItems) > 0)
        <div class="cart-main">
            <!-- Cart Items Section -->
            <div class="cart-items-section">
                <div id="cart-items">
                    @foreach($cartItems as $item)
                        <div class="cart-item" data-item-id="{{ $item->id }}">
                            <img src="{{ $item->product_image }}" alt="{{ $item->product_name }}" class="item-image">
                            
                            <div class="item-details">
                                <h3 class="item-name">{{ $item->product_name }}</h3>
                                <p class="item-price">₹{{ number_format($item->price) }} each</p>
                                
                                <div class="quantity-controls">
                                    <button class="qty-btn" onclick="updateQuantity({{ $item->id }}, -1)" 
                                            {{ $item->quantity <= 1 ? 'disabled' : '' }}>−</button>
                                    <input type="number" class="qty-input" value="{{ $item->quantity }}" 
                                           min="1" max="{{ $item->stock }}" 
                                           onchange="updateQuantity({{ $item->id }}, this.value, true)">
                                    <button class="qty-btn" onclick="updateQuantity({{ $item->id }}, 1)"
                                            {{ $item->quantity >= $item->stock ? 'disabled' : '' }}>+</button>
                                    <span style="margin-left: 0.5rem; color: #6b7280; font-size: 0.875rem;">
                                        ({{ $item->stock }} available)
                                    </span>
                                </div>
                            </div>
                            
                            <div class="item-total">
                                ₹{{ number_format($item->total) }}
                            </div>
                            
                            <button class="remove-btn" onclick="removeItem({{ $item->id }})" title="Remove item">
                                🗑️
                            </button>
                        </div>
                    @endforeach
                </div>
                
                <!-- Continue Shopping Link -->
                <a href="{{ route('products.index') }}" class="continue-shopping">
                    ← Continue Shopping
                </a>
            </div>

            <!-- Cart Summary -->
            <div class="cart-summary">
                <h2 class="summary-title">Order Summary</h2>
                
                <div class="summary-row">
                    <span>Subtotal ({{ $cartCount }} items)</span>
                    <span>₹{{ number_format($cartTotal) }}</span>
                </div>
                
                <div class="summary-row">
                    <span>Delivery Fee</span>
                    <span>
                        @if($deliveryFee == 0)
                            <span style="color: #16a34a;">FREE</span>
                        @else
                            ₹{{ number_format($deliveryFee) }}
                        @endif
                    </span>
                </div>
                
                @if($cartTotal < 1000)
                    <div style="background: #fef3c7; padding: 0.75rem; border-radius: 6px; margin: 1rem 0; text-align: center; font-size: 0.875rem;">
                        Add ₹{{ number_format(1000 - $cartTotal) }} more for FREE delivery!
                    </div>
                @endif
                
                <!-- Promo Code Section -->
                <div class="promo-section">
                    <p style="font-weight: 500; margin-bottom: 0.5rem;">🎟️ Have a promo code?</p>
                    <div class="promo-input">
                        <input type="text" placeholder="Enter promo code" id="promo-code">
                        <button class="apply-btn" onclick="applyPromo()">Apply</button>
                    </div>
                </div>
                
                <div class="summary-row">
                    <span>Total</span>
                    <span>₹{{ number_format($grandTotal) }}</span>
                </div>
                
                <a id="proceed-checkout" href="{{ route('checkout.index') }}" class="checkout-btn" style="display:inline-block; text-decoration:none; text-align:center;">
                    🚀 Proceed to Checkout
                </a>
            </div>
        </div>
    @else
        <!-- Empty Cart State -->
        <div class="empty-cart">
            <div class="empty-cart-icon">🛒</div>
            <h2 class="empty-cart-title">Your cart is empty</h2>
            <p class="empty-cart-subtitle">Looks like you haven't added any items to your cart yet.</p>
            <a href="{{ route('products.index') }}" class="checkout-btn" style="display: inline-block; text-decoration: none;">
                🛍️ Start Shopping
            </a>
        </div>
    @endif
</div>

<!-- Login Modal -->
<div id="login-modal" class="modal-overlay">
    <div class="modal-content">
        <h2 class="modal-title">🔐 Login to Continue</h2>
        <p style="text-align: center; color: #6b7280; margin-bottom: 1.5rem;">
            Please login to proceed with your order
        </p>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" name="intended" value="{{ route('checkout.index') }}">
            
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            
            <div class="modal-actions">
                <button type="button" id="login-cancel" class="btn-secondary">Cancel</button>
                <button type="submit" class="btn-primary">Login & Checkout</button>
            </div>
        </form>
        
        <p style="text-align: center; margin-top: 1rem; color: #6b7280;">
            Don't have an account? 
            <a href="{{ route('register') ?? '#' }}" style="color: #16a34a; font-weight: 500;">Sign up here</a>
        </p>
    </div>
</div>

<script>
(function(){
    function isAuthenticated(){
        return {{ auth()->check() ? 'true' : 'false' }};
    }
    
    const checkoutBtn = document.getElementById('proceed-checkout');
    const modal = document.getElementById('login-modal');
    const cancelBtn = document.getElementById('login-cancel');
    
    // Checkout button click
    checkoutBtn && checkoutBtn.addEventListener('click', function(e){
        if(!isAuthenticated()){
            e.preventDefault();
            modal.style.display = 'block';
        }
    });
    
    // Modal close events
    cancelBtn && cancelBtn.addEventListener('click', function(){
        modal.style.display = 'none';
    });
    
    modal && modal.addEventListener('click', function(e){
        if(e.target === modal){
            modal.style.display = 'none';
        }
    });
    
    // Escape key to close modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.style.display === 'block') {
            modal.style.display = 'none';
        }
    });
})();

// Quantity update function
function updateQuantity(itemId, change, absolute = false) {
    const cartItem = document.querySelector(`[data-item-id="${itemId}"]`);
    const qtyInput = cartItem.querySelector('.qty-input');
    const currentQty = parseInt(qtyInput.value);
    const maxStock = parseInt(qtyInput.getAttribute('max'));
    
    let newQty;
    if (absolute) {
        newQty = parseInt(change);
    } else {
        newQty = currentQty + parseInt(change);
    }
    
    // Validate quantity
    if (newQty < 1) newQty = 1;
    if (newQty > maxStock) newQty = maxStock;
    
    qtyInput.value = newQty;
    
    // Update total price for this item
    const pricePerItem = {{ json_encode(collect($cartItems)->pluck('price', 'id')) }}[itemId];
    const newTotal = pricePerItem * newQty;
    cartItem.querySelector('.item-total').textContent = `₹${newTotal.toLocaleString()}`;
    
    // Update quantity control buttons
    const minusBtn = cartItem.querySelector('.qty-btn:first-child');
    const plusBtn = cartItem.querySelector('.qty-btn:last-child');
    
    minusBtn.disabled = newQty <= 1;
    plusBtn.disabled = newQty >= maxStock;
    
    // Here you would typically send an AJAX request to update the server
    console.log(`Updated item ${itemId} quantity to ${newQty}`);
    updateCartSummary();
}

// Remove item function
function removeItem(itemId) {
    if (confirm('Are you sure you want to remove this item from your cart?')) {
        const cartItem = document.querySelector(`[data-item-id="${itemId}"]`);
        cartItem.style.animation = 'fadeOut 0.3s ease';
        
        setTimeout(() => {
            cartItem.remove();
            updateCartSummary();
            
            // Check if cart is empty
            const remainingItems = document.querySelectorAll('.cart-item');
            if (remainingItems.length === 0) {
                location.reload(); // Reload to show empty cart state
            }
        }, 300);
        
        console.log(`Removed item ${itemId} from cart`);
    }
}

// Update cart summary
function updateCartSummary() {
    // This would typically recalculate totals based on current quantities
    // For now, just a placeholder
    console.log('Cart summary updated');
}

// Apply promo code
function applyPromo() {
    const promoCode = document.getElementById('promo-code').value.trim();
    if (promoCode) {
        // Here you would send an AJAX request to validate and apply the promo code
        alert(`Promo code "${promoCode}" applied! (This is a demo)`);
        console.log(`Applied promo code: ${promoCode}`);
    }
}

// Add fadeOut animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeOut {
        from { opacity: 1; transform: translateX(0); }
        to { opacity: 0; transform: translateX(-20px); }
    }
`;
document.head.appendChild(style);
</script>

@endsection