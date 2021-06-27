<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryVoucher extends Model
{
    use HasFactory;

    protected $table = 'category_vouchers';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
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
        'is_direct_application',
        'reward_Point',
        'enable',
    ];

    public $timestamps = true;

    public function Category(){
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

    public function Vouchers(){
        return $this->belongsTo('App\Models\Voucher','voucher_id','id');
    }
}
