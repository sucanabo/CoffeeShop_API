<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use App\Models\UserVoucher;



class Voucher extends Model

{

    use HasFactory;



    protected $table = 'vouchers';



    protected $primaryKey = 'id';

    

    protected $fillable = 

    ['title',

    'content',

    'type',

    'coupon_code',

    'image',

    'qr_code',

    'start_date',

    'expiry_date',

    'discount_unit',

    'discount',

    'apply_for',

    'discount_object',

    'quantity_rule',

    'size_rule',

    'delivery_rule',

    'location_rule',

    'status',

    ];

    

    public $timestamps = true;
    protected $casts = [
        'discount' => 'integer',
        'status' => 'integer',
    ];
    public function userVouchers (){

        return $this->hasMany(UserVoucher::class,'voucher_id','id');

    }

}

