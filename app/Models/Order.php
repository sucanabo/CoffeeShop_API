<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'subtotal',
        'discount',
        'item_discount',
        'shipping',
        'promo',
        'grandtotal',
        'content',
        'status',
        'address',
        'phone',
    ];
}
