<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'vouchers';

    protected $primaryKey = 'id';
    
    protected $fillable = 
    ['title',
    'content',
    'coupen_code',
    'image',
    'qr_code',
    'start_date',
    'expiry_date',
    'discount_unit',
    'discount',
    'minimum_order',
    'is_reward_allowed',
    'reward_Point',
    'enable'
    ];
    
    public $timestamps = true;

    public function ProductVoucher(){
        return $this->hasMany('App\Models\ProductVoucher','voucher_id','id');
    }

    public function CategoryVoucher(){
        return $this->hasMany('App\Models\CategoryVoucher','category_id','id');
    }
}
