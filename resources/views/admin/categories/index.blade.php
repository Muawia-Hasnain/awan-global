@extends('layouts.admin')

@section('page-title', 'Categories Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">
        <i class="bi bi-tags me-2"></i>Categories & Sub Categories
    </h4>
    <div>
        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#quickAddCategoryModal">
            <i class="bi bi-plus-lg me-2"></i>Add Category
        </button>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#quickAddSubCategoryModal">
            <i class="bi bi-plus-lg me-2"></i>Add Subcategory
        </button>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($categories->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Parent</th>
                            <th>Products Count</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <!-- Main Category Row -->
                        <tr class="category-row">
                            <td>
                                @if($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" 
                                         alt="{{ $category->name }}" 
                                         class="img-thumbnail" 
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                         style="width: 60px; height: 60px; border-radius: 4px;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $category->name }}</strong>
                                @if($category->subcategories && $category->subcategories->count() > 0)
                                    <br><small class="text-primary">
                                        <i class="bi bi-arrow-down-short"></i>{{ $category->subcategories->count() }} Sub Categories
                                    </small>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-primary">Main Category</span>
                            </td>
                            <td>-</td>
                            <td>
                                <span class="badge bg-info">{{ $category->products_count }} Products</span>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" 
                                           type="checkbox" 
                                           data-id="{{ $category->id }}"
                                           data-type="category"
                                           {{ $category->status ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                        {{ $category->status ? 'Active' : 'Inactive' }}
                                    </label>
                                </div>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $category->created_at->format('M d, Y') }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('admin.categories.show', $category) }}" 
                                       class="btn btn-outline-info" 
                                       title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.categories.edit', $category) }}" 
                                       class="btn btn-outline-primary" 
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-outline-danger delete-category" 
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}"
                                            title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Sub Categories Rows -->
                        @foreach($category->subcategories as $subCategory)
                        <tr class="subcategory-row">
                            <td>
                                @if($subCategory->image)
                                    <img src="{{ asset('storage/' . $subCategory->image) }}" 
                                         alt="{{ $subCategory->name }}" 
                                         class="img-thumbnail" 
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px; border-radius: 4px;">
                                        <i class="bi bi-image text-muted" style="font-size: 0.8rem;"></i>
                                    </div>
                                @endif
                            </td>
                            <td style="padding-left: 2rem;">
                                <i class="bi bi-arrow-right text-muted me-1"></i>
                                <strong>{{ $subCategory->name }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-secondary">Sub Category</span>
                            </td>
                            <td>
                                <small class="text-muted">{{ $category->name }}</small>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $subCategory->products_count }} Products</span>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" 
                                           type="checkbox" 
                                           data-id="{{ $subCategory->id }}"
                                           data-type="subcategory"
                                           {{ $subCategory->status ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                        {{ $subCategory->status ? 'Active' : 'Inactive' }}
                                    </label>
                                </div>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $subCategory->created_at->format('M d, Y') }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('admin.subcategories.show', $subCategory) }}" 
                                       class="btn btn-outline-info" 
                                       title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.subcategories.edit', $subCategory) }}" 
                                       class="btn btn-outline-primary" 
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-outline-danger delete-subcategory" 
                                            data-id="{{ $subCategory->id }}"
                                            data-name="{{ $subCategory->name }}"
                                            title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $categories->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-tags text-muted" style="font-size: 4rem;"></i>
                <h4 class="mt-3 text-muted">No Categories Found</h4>
                <p class="text-muted">Start by creating your first category</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#quickAddCategoryModal">
                    <i class="bi bi-plus-lg me-2"></i>Create First Category
                </button>
            </div>
        @endif
    </div>
</div>

<!-- Delete Category Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the category "<strong id="categoryName"></strong>"?</p>
                <p class="text-danger"><small><i class="bi bi-exclamation-triangle"></i> This action cannot be undone.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Sub Category Modal -->
<div class="modal fade" id="deleteSubCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Sub Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the sub category "<strong id="subCategoryName"></strong>"?</p>
                <p class="text-danger"><small><i class="bi bi-exclamation-triangle"></i> This action cannot be undone.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteSubCategoryForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="quickAddCategoryModal" tabindex="-1" aria-labelledby="quickAddCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quickAddCategoryLabel">
                    <i class="bi bi-plus-lg me-2"></i>Add New Category
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Category Name *</label>
                        <input type="text" name="name" class="form-control" required placeholder="e.g. Electronics, Fashion">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="text-muted">Upload an image for this category</small>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="status" id="catStatus" checked>
                        <label class="form-check-label" for="catStatus">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Save Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Subcategory Modal -->
<div class="modal fade" id="quickAddSubCategoryModal" tabindex="-1" aria-labelledby="quickAddSubCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quickAddSubCategoryLabel">
                    <i class="bi bi-plus-lg me-2"></i>Add New Subcategory
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.subcategories.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Parent Category *</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">-- Select Parent Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Choose which category this subcategory belongs to</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subcategory Name *</label>
                        <input type="text" name="name" class="form-control" required placeholder="e.g. Mobile Phones, T-Shirts">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subcategory Image (optional)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="text-muted">Upload an image for this subcategory</small>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="status" id="subCatStatus" checked>
                        <label class="form-check-label" for="subCatStatus">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-2"></i>Save Subcategory
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.subcategory-row {
    background-color: #f8f9fa;
}
.subcategory-row:hover {
    background-color: #e9ecef;
}
.category-row {
    border-top: 2px solid #dee2e6;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Status Toggle for both categories and subcategories
    $('.status-toggle').change(function() {
        const id = $(this).data('id');
        const type = $(this).data('type');
        const isChecked = $(this).prop('checked');
        
        const url = type === 'category' 
            ? `/admin/categories/${id}/toggle-status`
            : `/admin/subcategories/${id}/toggle-status`;
        
        $.post(url, {
            _token: '{{ csrf_token() }}'
        })
        .done(function(response) {
            if(response.success) {
                const label = $(this).siblings('label');
                label.text(response.status ? 'Active' : 'Inactive');
                showAlert('success', response.message);
            }
        }.bind(this))
        .fail(function() {
            $(this).prop('checked', !isChecked);
            showAlert('error', 'Failed to update status');
        }.bind(this));
    });
    
    // Delete Category
    $('.delete-category').click(function() {
        const categoryId = $(this).data('id');
        const categoryName = $(this).data('name');
        $('#categoryName').text(categoryName);
        $('#deleteForm').attr('action', `/admin/categories/${categoryId}`);
        $('#deleteModal').modal('show');
    });
    
    // Delete Sub Category
    $('.delete-subcategory').click(function() {
        const subCategoryId = $(this).data('id');
        const subCategoryName = $(this).data('name');
        $('#subCategoryName').text(subCategoryName);
        $('#deleteSubCategoryForm').attr('action', `/admin/subcategories/${subCategoryId}`);
        $('#deleteSubCategoryModal').modal('show');
    });
    
    // Show Alert Function
    function showAlert(type, message) {
        const alertHtml = `
            <div class="alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show" role="alert">
                <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        $('.main-content .px-4').prepend(alertHtml);
        
        setTimeout(function() {
            $('.alert').fadeOut();
        }, 5000);
    }
});
</script>
@endpush