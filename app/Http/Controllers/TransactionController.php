<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\UserVoucher;
use App\Models\Order;

class TransactionController extends Controller
{
    function getPage(Request $request){
       

        $query = Transaction::query()->with('order')->with('order',function($order){
            return $order->with('address')->with('orderItems')->get();
        });
        
        if($status = $request['status']){
            if($status != null){
                $query->where('status',$status);
            }
        }
        
        $query->where('user_id', auth()->user()->id);
        $query->orderBy('created_at','DESC');

        $limit =  $request['limit']??10;
        $page = $request['page']??1;
        $totalRow = $query->count();

        $result = $query->offset(($page - 1) * $limit)
            ->limit($limit)
            ->get();
        

        return Response([
            'message'=>'success',
            'totalRow'=> $totalRow,
            'data'=>$result]
        );
    }
    function cancel(Request $request)
    {
        $attrs = $request->validate([
            'transaction_id' => 'required',
        ]);
        $transaction = Transaction::find($request->transaction_id);
        if (!$transaction) {
            return response(['message' => 'Transaction not found.'], 403);
        }
        $transaction->status = 'cancelled';
        $transaction->save();

        //get order
        $order = Order::find($transaction->order_id);
        $promo = json_decode('[' . $order->promo . ']', true);
        //update voucher status
        $vouchers = UserVoucher::where('user_id', auth()->user()->id)
            ->whereIn('voucher_id', $promo)
            ->update(['status' => 1]);
        return response(['messages' => 'Cancelled transaction succes.', 'transaction' => $transaction, 'voucher_cancelled' => $vouchers], 200);
    }
}
