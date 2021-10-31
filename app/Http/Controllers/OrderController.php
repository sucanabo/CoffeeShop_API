<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\UserVoucher;
use App\Models\Product;
use App\Models\Transaction;

use DB;

class OrderController extends Controller
{
    function show($id){
        $order = Order::find($id);
        if(!$order){
            return response(['message' => 'Order not found.'],403);
        }
        $query = Order::where('id', $id)->first()->with('orderItems')->get();
        return response(['message' => 'success', 'data' => $query],200);
    }
    function create(Request $request){
        DB::beginTransaction();
        try{
            //validate
            $attrs = $request->validate([
                'address_id' => 'required',
            ]);
            //get item list
            $items = $request['items'];

            //create order
            $order = Order::create(
                [
                    'user_id' => auth()->user()->id,
                    'address_id' => $request['address_id'],
                    'shipping' => $request['shipping'],
                    'subtotal' => $request['subtotal'],
                    'voucher_discount' => $request['voucher_discount'],
                    'shipping_discount' => $request['shipping_discount'],
                    'promo' => $request['promo'],
                    'grandtotal' => $request['grandtotal'],
                    'content' => $request['content'],
                ]
            );
            //create order items
            
            foreach($items as $index){
                $new_item =  OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $index['product_id'],
                    'item_detail' => json_encode($index['item_detail']),
                    'quantity' => $index['quantity'],
                    'content' => $index['content'],
                 ]);
             }
            //create and updat transaction 
            $latestOrder = Order::orderBy('created_at','DESC')->first();
             $transaction = Transaction::create([
                'user_id' =>  auth()->user()->id,
                'delivery_method' => $request['delivery_method'],
                'order_id' => $order->id,
                'code' => '#'.str_pad($latestOrder->id + 1, 8, "0", STR_PAD_LEFT),
                'type' => 'cash',
                'mode' => 'online',
                'status' => 'pending',
             ]);

            // //delete user voucher
            // $promos = $request['promo'];
            // if($promos != null){
            //     foreach($promos as $index){
            //         UserVoucher::where('id',$index)->update(['status' => 0]);
            //     }
            // }
            // //update user's point and level
            // $new_point = $user->total_point + round($request['grandtotal']);
            // User::where('id',$request->user_id)->update(['total_point' => $new_point]);
            // $new_level = 0;
            // $level_list = array([100,300,600,1000,3000,5000,10000]);//new, bzone, sivil, gold, platinum, diamond, V.I.P
            // foreach($level_list as $key => $value){
            //     if($new_point <= $value){
            //         $new_level = $key;
            //         break;
            //     } 
            // }

            DB::commit();
            return response(['message' => 'success','data' => $transaction],200);
        }
        catch(Exception $e){
            DB::rollback();
            return response(['message' => 'create order failded'],500);
            throw new Exception($e -> getMessage());
        }
    }
}
