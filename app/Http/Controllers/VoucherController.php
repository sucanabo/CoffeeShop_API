<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use Carbon\Carbon;
class VoucherController extends Controller
{
    public function index(){
        return response([
            'message'=>'success.',
            'vouchers' => Voucher::orderby('created_at','desc')
            ->whereDate('expiry_date', '>=',Carbon::today())
            ->where('status',1)
            ->where('type','public')
            ->get()
        ],200);
    }
}
