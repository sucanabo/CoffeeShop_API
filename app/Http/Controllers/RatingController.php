<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Product;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $product = Product::find($id);

        if(!$product){
            return response(['message' => 'Product not found.'], 403);
        }

        return response([
            'ratings' => $product->ratings()->with('user:id,username')->get()
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $prodcut = Product::find($id);

        if($product){
            return response(['message' => 'Product not found.'], 403);
        }

        $attrs = $request->validate([
            'star' => 'required',
        ]);

        Rating::create([
            'user_id' => auth()->user()->id,
            'product_id' => $id,
            'star' => $attrs['star'],
        ]);

        return response([
            'message' => 'Rating created.',
        ],200);
        
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $rating = Rating::find($id);

        if(!$rating){
            return response([
                'message' => 'Rating not found.'
            ],403);
        }

        if($rating->user_id != auth()->user()->id){
            return  response([
                'message' => 'Permission dined.'
            ], 403);
        }

        $attrs = $request->validate([
            'star' => 'required',
        ]);

        $rating->update([
            'star' => $attrs['star']
        ]);

        return response(['message' => 'Rating edited.'],200);
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
        $rating = Rating::find($id);

        if(!$rating){
            return response(['message' => 'Rating not found.'],403);
        }

        if($rating->user_id != auth()->user()->id){
            return  response([
                'message' => 'Permission dined.'
            ], 403);
        }

        $rating->delete();
        
        return response(['message' => 'Rating deleted.'],200);
    }
}
