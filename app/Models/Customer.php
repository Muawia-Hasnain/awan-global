<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    /**
     * A customer may have many orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
