<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'status',
        'address',
        'phone',
    ];

    public $timestamps = true;

    public function User(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function CartItems(){
        return $this->hasMany('App\Models\CartItem','cart_id','id');
    }
}
