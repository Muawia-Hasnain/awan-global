<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',  // Added subcategory support
        'name',
        'slug',
        'description',
        'short_description',
        'sku',
        'retail_price',
        'wholesale_price',
        'wholesale_min_qty',
        'stock_quantity',
        'manage_stock',
        'stock_status',
        'product_type',
        'images',
        'featured_image',
        'meta_title',
        'meta_description',
        'status',
        // Removed 'is_featured' since column is deleted
        'weight',
        'weight_unit'
    ];

    protected $casts = [
        'images' => 'array',
        'retail_price' => 'decimal:2',
        'wholesale_price' => 'decimal:2',
        'weight' => 'decimal:2',
        'status' => 'boolean',
        // Removed 'is_featured' => 'boolean',
        'manage_stock' => 'boolean'
    ];

    // Auto generate slug and SKU
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
            if (empty($product->sku)) {
                $product->sku = 'AWN-' . strtoupper(Str::random(6));
            }
            
            // Auto set stock_status based on stock_quantity
            $product->stock_status = $product->stock_quantity > 0 ? 'in_stock' : 'out_of_stock';
        });
        
        static::updating(function ($product) {
            $product->slug = Str::slug($product->name);
            
            // Auto update stock_status when stock_quantity changes
            if ($product->isDirty('stock_quantity')) {
                $product->stock_status = $product->stock_quantity > 0 ? 'in_stock' : 'out_of_stock';
            }
        });
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeRetail($query)
    {
        return $query->whereIn('product_type', ['retail', 'both']);
    }

    public function scopeWholesale($query)
    {
        return $query->whereIn('product_type', ['wholesale', 'both']);
    }

    // Removed featured scope since column is deleted
    // public function scopeFeatured($query)
    // {
    //     return $query->where('is_featured', 1);
    // }

    public function scopeInStock($query)
    {
        return $query->where('stock_status', 'in_stock')
                    ->where('stock_quantity', '>', 0);
    }

    public function scopeOutOfStock($query)
    {
        return $query->where('stock_status', 'out_of_stock')
                    ->orWhere('stock_quantity', '<=', 0);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeBySubcategory($query, $subcategoryId)
    {
        return $query->where('subcategory_id', $subcategoryId);
    }

    // Accessors
    public function getFormattedRetailPriceAttribute()
    {
        return 'Rs. ' . number_format($this->retail_price, 0);
    }

    public function getFormattedWholesalePriceAttribute()
    {
        return 'Rs. ' . number_format($this->wholesale_price, 0);
    }

    public function getFirstImageAttribute()
    {
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }
        
        if ($this->images && count($this->images) > 0) {
            return asset('storage/' . $this->images[0]);
        }
        
        return asset('images/no-image.png');
    }

    public function getPriceRangeAttribute()
    {
        $prices = [];
        if ($this->retail_price) {
            $prices[] = $this->retail_price;
        }
        if ($this->wholesale_price) {
            $prices[] = $this->wholesale_price;
        }
        
        if (empty($prices)) {
            return 'No Price Set';
        }
        
        $min = min($prices);
        $max = max($prices);
        
        if ($min == $max) {
            return 'Rs. ' . number_format($min, 0);
        }
        
        return 'Rs. ' . number_format($min, 0) . ' - Rs. ' . number_format($max, 0);
    }

    // Check if product is available for purchase
    public function getIsAvailableAttribute()
    {
        return $this->status && $this->stock_status === 'in_stock' && $this->stock_quantity > 0;
    }

    // Get stock status with color class for UI
    public function getStockStatusClassAttribute()
    {
        switch ($this->stock_status) {
            case 'in_stock':
                return 'success';
            case 'out_of_stock':
                return 'danger';
            default:
                return 'secondary';
        }
    }
}