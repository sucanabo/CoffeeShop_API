<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
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

    public $timestamps = true;

    public function OrderItems(){
        return $this->hasMany('App\Models\OrderItem','order_id','id');
    }

    public function User(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
