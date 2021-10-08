<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Voucher;


class UserVoucher extends Model
{

    use HasFactory;

    protected $table = 'user_vouchers';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'voucher_id',
        'user_code',
        'status'
    ];
    
    public $timestamps = true;


    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function voucher(){
        return $this->belongsTo(Voucher::class,'voucher_id','id');
    }
}
