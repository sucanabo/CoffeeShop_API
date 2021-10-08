<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Voucher;
use App\Models\UserVoucher;
class Reward extends Model
{
    use HasFactory;

    protected $table = 'rewards';

    protected $primaryKey = 'id';
    protected $fillable = [
        'voucher_id',
        'title',
        'brand_name',
        'content',
        'point',
        'status',
    ];
    protected $appends = [
        'exchangeCount',
    ];

    public $timestamps = true;

    public function voucher(){
        return $this->belongsTo(Voucher::class,'voucher_id','id');
    }
    public function getExchangeCountAttribute(){
        return UserVoucher::where('voucher_id',$this->voucher_id)->count();
    }
}
