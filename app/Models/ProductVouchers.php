<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVouchers extends Model
{
    use HasFactory;

    protected $table = 'product_vouchers';

    protected $primaryKey = 'id';
    
    protected $fillable = ['product_id','voucher_id','status',];
    
    public $timestamps = true;
}
