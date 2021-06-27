<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_items';

    protected $primaryKey = 'id';

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'content',
    ];

    public $timestamps = true;

    public function Cart(){
        return $this->belongsTo('App\Models\Cart','cart_id','id');
    }

    public function Product(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
}
