<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;
use Illuminate\Support\Str;
use App\Models\Voucher;
use App\Models\UserVoucher;
use Illuminate\Support\Facades\Auth;
use DB;

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
            'message' => 'success.',
            'rewards' => Reward::orderby('rewards.created_at', 'asc')
                ->join('vouchers as v', 'v.id', '=', 'voucher_id')
                ->where('rewards.status', 1)
                ->select('rewards.id', 'rewards.voucher_id', 'brand_name', 'rewards.title', 'rewards.content', 'point', 'rewards.image')
                ->get()
        ], 200);
    }
    public function redeem(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $reward = Reward::find($id);
            if (!$reward) {
                return response(['message' => 'Reward not found.'], 403);
            }
            $voucher = Voucher::find($reward->voucher_id);
            if (!$voucher) {
                return response(['message' => 'Voucher not found.'], 403);
            }
            $user = Auth::user();
            if ($user->point < $reward->point) {
                return response(['message' => 'you don\'t have enough points to redeem this gift.'], 400);
            }
            $code = '';
            while (true) {
                $code = Str::random(6);
                if (!strpos($voucher->voucher_id, $code) !== false) {
                    break;
                }
            }
            $voucher->coupon_code = $voucher->coupon_code . ',' . $code;
            $voucher->save();

            $user_voucher = UserVoucher::create([
                'user_id' => $user->id,
                'voucher_id' => $voucher->id,
                'user_code' => $code,
                'status' => 1,
            ]);
            $user->point = $user->point - $reward->point;
            $user->save();
            DB::commit();
            return response([
                'message' => 'success',
                'user_voucher' => $user_voucher,
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response(['message' => 'get reward failded'], 500);
            throw new Exception($e->getMessage());
        }
    }
}
