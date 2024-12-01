<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';

    protected $fillable = [
        'checkout_id', 
        'product_id', 
        'image',
        'title',
        'description',
        'quantity',
        'price',
        'discount', 
        'subtotal',
    ];
    
    // Relasi ke checkout
    public function checkout()
    {
        return $this->belongsTo(Checkout::class);
    }

    // Relasi ke produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}