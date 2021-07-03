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
            'products' => Product::orderby('created_at','desc')
            ->withCount('ratings')
            ->with(
                'favourites', function($favourite){
                    return $favourite->where('user_id', auth()->user()->id)
                    ->select('id','user_id','product_id')
                    ->get();
                }
            )
            ->get()
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $attrs = $request->validate([
            'title' => 'required|string',
            'price' => 'required',
        ]);

        //$image = $this->saveImage($request->image, 'products');

        $product = Product::create([
        'category_id' => $request['category_id'],
        'title'=> $request['title'],
        'type'=> $request['type'],
        'price'=> $request['price'],
        'image'=> $request['image'],
        'content'=> $request['content'],
        ]);

        return response([
            'message' => 'Product created.',
            'product' => $product,
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response([
            'product' => Product::where('id',$id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $product = Product::find($id);

        if(!$product){
            return response([
                'message' => 'Product not found.'
            ],403);
        }
        
        //Only admin can edit
        // if(auth()->user()->role_id != 1){
        //     return response([
        //         'message' => 'Permission denied.'
        //     ]);
        // }

        $product->update($request->all());

        return response([
            'message' => 'Product edited.',
            'product' => $product
        ],200);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if(!$product){
            return response([
                'message' => 'Product not found.'
            ],403);
        }
        //Only admin can edit
        // if(auth()->user()->role_id != 1){
        //     return response([
        //         'message' => 'Permission denied.'
        //     ]);
        // }

        $product->ratings()->delete();
        $product->productVouchers()->delete();
        $product->productOptions()->delete();
        $product->orderItems()->delete();
        $product->delete();

        return response([
            'message' => 'Product deleted.'
        ],200);

    }
}
