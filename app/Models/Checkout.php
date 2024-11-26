<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $table = 'checkouts';

    protected $fillable = [
        'customer_id',
        'customer_name',
        'customer_address',
        'customer_city',
        'customer_pos_code',
        'customer_phone',
        'total_discount',
        'total_price',
        'shipping_cost',
        'final_total_price',
        'status',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }
}