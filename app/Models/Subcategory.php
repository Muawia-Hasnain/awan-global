<?php
// app/Models/Subcategory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'image',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
        'category_id' => 'integer'
    ];

    /**
     * Boot the model to auto-generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subcategory) {
            if (empty($subcategory->slug)) {
                $subcategory->slug = Str::slug($subcategory->name);
                
                // Ensure unique slug
                $originalSlug = $subcategory->slug;
                $counter = 1;
                while (static::where('slug', $subcategory->slug)->exists()) {
                    $subcategory->slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }
        });

        static::updating(function ($subcategory) {
            if ($subcategory->isDirty('name') ) {
                $subcategory->slug = Str::slug($subcategory->name);
                
                // Ensure unique slug (excluding current record)
                $originalSlug = $subcategory->slug;
                $counter = 1;
                while (static::where('slug', $subcategory->slug)->where('id', '!=', $subcategory->id)->exists()) {
                    $subcategory->slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }
        });
    }

    /**
     * Get the category that owns this subcategory
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope to get only active subcategories
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Get the route key for the model
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}