<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\UserVoucher;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'message'=>'success.',
            'rewards' => Reward::orderby('rewards.created_at','asc')
            ->join('vouchers as v','v.id','=','voucher_id')
            ->where('rewards.status',1)
            ->select('rewards.id','rewards.voucher_id','brand_name','rewards.title','rewards.content','point','rewards.image')
            ->get()
        ],200);
    }
}
