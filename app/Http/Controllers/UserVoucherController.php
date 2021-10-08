<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\UserVoucher;

class UserVoucherController extends Controller
{
    public function index(){
        return response([
            'message'=>'success.',
            'vouchers' => UserVoucher::orderby('user_vouchers.created_at','asc')
            ->join('vouchers as v','v.id','=','user_vouchers.voucher_id')
            ->where('user_vouchers.status',1)
            ->where('user_vouchers.user_id',auth()->user()->id)
            ->get()
        ],200);
    }
    public function saveVoucher($id){
        $voucher = Voucher::find($id);
        if(!$voucher){
            response(['message'=> 'Voucher not found.'],403);
        }
        $user_voucher = UserVoucher::create([
            'user_id' => auth()->user()->id,
            'voucher_id' => $id,
        ]);
        return response(['message'=>'Save voucher success.','voucher'=>$user_voucher],200);
    }
    public function useVoucher($id){
        $user_voucher = UserVoucher::find($id);
        if(!$user_voucher){
            return response(['message'=>'voucher of user not found.'],403);
        }
        $user_voucher->update(['status'=>1]);
        return response(['message'=>'voucher has been used.','voucher'=>$user_voucher],200);
    }
}
