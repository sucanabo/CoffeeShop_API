<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    function getPage(Request $request){
        $limit =  $request['limit']??10;
        $page = $request['page']??1;
        $status = $request['status'];
        $query = Transaction::query();
        if($status != null){
            $query->where('status',$status);
        }
        $result = $query->offset(($page - 1) * $limit)->limit($limit)->where('user_id', auth()->user()->id)->get();
        $totalRow = $query->count();

        return Response([
            'message'=>'success',
            'totalRow'=> $totalRow,
            'limit' => $request['limit'],
            'page'=>$request['page'],
            'data'=>$result]
        );
    }
}
