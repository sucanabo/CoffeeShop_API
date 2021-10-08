<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;


class OrderController extends Controller
{
    function create(Request $request){
        
        $attrs = $request->validate([
            'user_id' => 'required',
        ]);
        $order = Order::create(
            [
                'user_id' => $attrs['user_id'],
                'address_id' => $attrs['address_id'],
                'subtotal' => $attrs['subtotal'],
                'voucher_discount' => $attrs['voucher_discount'],
                'shipping_discount' => $attrs['shipping_discount'],
                'shipping' => $attrs['shipping'],
                'promo' => $attrs['promo'],
                'grandtotal' => $attrs['grandtotal'],
                'content' => $attrs['content'],
                'status' => $attrs['status']??1,
            ]
            );
            
        //tao order moi
        //cap nhat point cua nguoi dung
        //them vao 
    }
}
