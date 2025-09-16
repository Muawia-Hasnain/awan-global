@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Stats Cards -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="bi bi-box-seam fs-1 mb-2"></i>
                <h4>{{ $stats['total_products'] }}</h4>
                <p class="mb-0">Total Products</p>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stats-card-success">
            <div class="card-body text-center">
                <i class="bi bi-tags fs-1 mb-2"></i>
                <h4>{{ $stats['total_categories'] }}</h4>
                <p class="mb-0">Categories</p>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stats-card-warning">
            <div class="card-body text-center">
                <i class="bi bi-cart3 fs-1 mb-2"></i>
                <h4>{{ $stats['total_orders'] ?? 0 }}</h4>
                <p class="mb-0">Total Orders</p>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stats-card-info">
            <div class="card-body text-center">
                <i class="bi bi-people fs-1 mb-2"></i>
                <h4>{{ $stats['total_customers'] ?? 0 }}</h4>
                <p class="mb-0">Customers</p>
            </div>
        </div>
    </div>
</div>

<!-- Additional Stats Row -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card border-primary">
            <div class="card-body text-center">
                <i class="bi bi-bag-check text-primary fs-3"></i>
                <h5 class="mt-2">{{ $stats['retail_products'] }}</h5>
                <small class="text-muted">Retail Products</small>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card border-success">
            <div class="card-body text-center">
                <i class="bi bi-boxes text-success fs-3"></i>
                <h5 class="mt-2">{{ $stats['wholesale_products'] }}</h5>
                <small class="text-muted">Wholesale Products</small>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card border-warning">
            <div class="card-body text-center">
                <i class="bi bi-star text-warning fs-3"></i>
                <h5 class="mt-2">{{ $stats['total_subcategories'] }}</h5>
                <small class="text-muted">Featured Products</small>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card border-danger">
            <div class="card-body text-center">
                <i class="bi bi-exclamation-triangle text-danger fs-3"></i>
                <h5 class="mt-2">{{ $stats['out_of_stock'] }}</h5>
                <small class="text-muted">Out of Stock</small>
            </div>
        </div>
    </div>
</div>

<!-- Recent Products -->
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-clock-history me-2"></i>Recent Products
                </h5>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#quickAddProductModal">
                    <i class="bi bi-plus-lg"></i> Add Product
                </button>
            </div>
            <div class="card-body">
                @if($recent_products->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Category/Subcategory</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_products as $product)
                                <tr>
                                    <td>
                                        <img src="{{ $product->first_image }}" 
                                             alt="{{ $product->name }}" 
                                             class="img-thumbnail" 
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <strong>{{ $product->name }}</strong>
                                        <br><small class="text-muted">SKU: {{ $product->sku }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $product->category->name }}</span>
                                        @if($product->subcategory)
                                            <br><span class="badge bg-light text-dark mt-1">{{ $product->subcategory->name }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->product_type == 'both')
                                            <span class="badge bg-info">Both</span>
                                        @elseif($product->product_type == 'retail')
                                            <span class="badge bg-primary">Retail</span>
                                        @else
                                            <span class="badge bg-success">Wholesale</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->retail_price)
                                            <small>R: {{ $product->formatted_retail_price }}</small><br>
                                        @endif
                                        @if($product->wholesale_price)
                                            <small>W: {{ $product->formatted_wholesale_price }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->stock_quantity > 0)
                                            <span class="badge bg-success">{{ $product->stock_quantity }}</span>
                                        @else
                                            <span class="badge bg-danger">Out of Stock</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.products.edit', $product) }}" 
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-box-seam text-muted" style="font-size: 3rem;"></i>
                        <h5 class="mt-3 text-muted">No Products Yet</h5>
                        <p class="text-muted">Start by adding your first product!</p>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg"></i> Add First Product
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-lightning me-2"></i>Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#quickAddProductModal">
                        <i class="bi bi-plus-lg me-2"></i>Add New Product
                    </button>
                    
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-primary">
                        <i class="bi bi-tags me-2"></i>Add Category
                    </a>
                    
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-list me-2"></i>View All Products
                    </a>
                    
                    <a href="#" class="btn btn-outline-info">
                        <i class="bi bi-truck me-2"></i>Wholesale Inquiries
                    </a>
                </div>
            </div>
        </div>
        
        <!-- System Info -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="bi bi-info-circle me-2"></i>System Info
                </h6>
            </div>
            <div class="card-body">
                <small class="text-muted">
                    <strong>Laravel:</strong> {{ app()->version() }}<br>
                    <strong>PHP:</strong> {{ PHP_VERSION }}<br>
                    <strong>Last Update:</strong> {{ now()->format('M d, Y') }}
                </small>
            </div>
        </div>
    </div>
</div>

<!-- Quick Add Product Modal - WITH SUBCATEGORY SUPPORT -->
<div class="modal fade" id="quickAddProductModal" tabindex="-1" aria-labelledby="quickAddProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quickAddProductLabel"><i class="bi bi-plus-lg me-2"></i>Quick Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" id="quickAddForm">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">Product Name *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        
                        <!-- Category & Subcategory Row -->
                        <div class="col-md-6">
                            <label class="form-label">Category *</label>
                            <select name="category_id" id="categorySelect" class="form-select" required>
                                <option value="" selected disabled>Choose Category...</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Subcategory</label>
                            <select name="subcategory_id" id="subcategorySelect" class="form-select">
                                <option value="">No Subcategory</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Product Type *</label>
                            <select name="product_type" class="form-select" required>
                                <option value="retail" selected>Retail Only</option>
                                <option value="wholesale">Wholesale Only</option>
                                <option value="both">Both Retail & Wholesale</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">SKU</label>
                            <input type="text" name="sku" class="form-control" placeholder="Auto-generated if empty">
                        </div>
                        
                        <!-- Pricing Row -->
                        <div class="col-md-6">
                            <label class="form-label">Retail Price *</label>
                            <div class="input-group">
                                <span class="input-group-text">Rs</span>
                                <input type="number" step="0.01" name="retail_price" class="form-control" placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Stock Quantity *</label>
                            <input type="number" name="stock_quantity" class="form-control" value="0" min="0" required>
                        </div>
                        
                        <!-- Wholesale Pricing (Initially Hidden) -->
                        <div class="col-md-6" id="wholesalePriceField" style="display: none;">
                            <label class="form-label">Wholesale Price</label>
                            <div class="input-group">
                                <span class="input-group-text">Rs</span>
                                <input type="number" step="0.01" name="wholesale_price" class="form-control" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-6" id="wholesaleMinQtyField" style="display: none;">
                            <label class="form-label">Wholesale Min Qty</label>
                            <input type="number" name="wholesale_min_qty" class="form-control" value="10" min="1">
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label">Short Description</label>
                            <input type="text" name="short_description" class="form-control" maxlength="200" placeholder="Brief product description">
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label">Featured Image *</label>
                            <input type="file" name="featured_image" class="form-control" accept="image/*" required>
                            <small class="form-text text-muted">Required: Main product image</small>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" checked>
                                <label class="form-check-label" for="statusSwitch">
                                    Product Active
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check2"></i> Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('categorySelect');
    const subcategorySelect = document.getElementById('subcategorySelect');
    const productTypeSelect = document.querySelector('select[name="product_type"]');
    const wholesalePriceField = document.getElementById('wholesalePriceField');
    const wholesaleMinQtyField = document.getElementById('wholesaleMinQtyField');
    
    // Handle Product Type Change
    productTypeSelect.addEventListener('change', function() {
        if (this.value === 'wholesale' || this.value === 'both') {
            wholesalePriceField.style.display = 'block';
            wholesaleMinQtyField.style.display = 'block';
        } else {
            wholesalePriceField.style.display = 'none';
            wholesaleMinQtyField.style.display = 'none';
        }
    });
    
    // Handle Category Change - Load Subcategories
    categorySelect.addEventListener('change', function() {
        const categoryId = this.value;
        subcategorySelect.innerHTML = '<option value="">Loading...</option>';
        
        if (categoryId) {
            fetch(`/admin/get-subcategories/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    subcategorySelect.innerHTML = '<option value="">No Subcategory</option>';
                    data.subcategories.forEach(sub => {
                        subcategorySelect.innerHTML += `<option value="${sub.id}">${sub.name}</option>`;
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    subcategorySelect.innerHTML = '<option value="">Error loading</option>';
                });
        } else {
            subcategorySelect.innerHTML = '<option value="">No Subcategory</option>';
        }
    });
    
    // Form Validation
    document.getElementById('quickAddForm').addEventListener('submit', function(e) {
        const name = document.querySelector('input[name="name"]').value;
        const categoryId = document.querySelector('select[name="category_id"]').value;
        const retailPrice = document.querySelector('input[name="retail_price"]').value;
        const featuredImage = document.querySelector('input[name="featured_image"]').files.length;
        
        if (!name || !categoryId || !retailPrice || featuredImage === 0) {
            e.preventDefault();
            alert('Please fill all required fields (Name, Category, Retail Price, Featured Image)');
        }
    });
});
</script>
@endpush