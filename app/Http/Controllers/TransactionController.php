<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    function getPage(Request $request){
       

        $query = Transaction::query()->with('order')->with('order',function($order){
            return $order->with('address')->get();
        });
        
        if($status = $request['status']){
            $query->where('status',$status);
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
}
