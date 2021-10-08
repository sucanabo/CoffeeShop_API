<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
class VoucherController extends Controller
{
    public function index(){
        return response([
            'message'=>'success.',
            'vouchers' => Voucher::orderby('created_at','desc')
            ->with('userVouchers',function($voucher){
                return $voucher->where('user_id',auth()->user()->id)
                ->select('id','user_id','voucher_id')
                ->get();
            })
            ->where('status',1)
            ->where('type','public')
            ->get()
        ],200);
    }
}
