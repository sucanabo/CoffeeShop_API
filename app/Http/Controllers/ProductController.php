<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rating;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'message' => 'success',
            'products' => Product::orderby('created_at','asc')
            ->with(
                'favourites', function($favourite){
                    return $favourite->where('user_id', auth()->user()->id)
                    ->select('id','user_id','product_id')
                    ->get();
                }
            )
            ->with('productToppings', function($product){
                return $product->join('toppings','topping_id','=','toppings.id')
                ->join('toppings as t','topping_id','=','t.id')
                ->get();
            })
            ->get()
        ],200);
    }
    public function condition(Request $request){
        $attrs = $request->validate([
            'condition' => 'required|string',
            'limit' => 'required|integer'
        ]);
        $condition = $request['condition'];
        $limit = $request['limit'];

        switch ($condition){
            case 'new':
                return response([
                    'products' => Product::orderby('created_at','desc')->with(
                        'favourites', function($favourite){
                            return $favourite->where('user_id', auth()->user()->id)
                            ->select('id','user_id','product_id')
                            ->get();
                        }
                    )->take($limit)->get()
                ],200);
                break;
            case 'sale': 
                return response(['message' => 'Coming soon.'],200);
        }
    }
}
