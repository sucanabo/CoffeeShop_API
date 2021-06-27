<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVoucher extends Model
{
    use HasFactory;

    protected $table = 'product_vouchers';

    protected $primaryKey = 'id';
    
    protected $fillable = ['product_id','voucher_id','status',];
    
    public $timestamps = true;

    public function Product(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }

    public function Voucher(){
        return $this->belongsTo('App\Models\Voucher','voucher_id','id');
    }
}
