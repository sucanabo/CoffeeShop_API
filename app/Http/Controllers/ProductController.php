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
            'products' => Product::orderby('created_at','desc')->with('avgRating')->get(),
            'message' => 'success'
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
            'content' => 'required|string',
        ]);

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

        $attrs = $request->validate([
            'title' => 'string',
            'content' => 'string',
        ]);
        $product->update($request->all());

        return response([
            'message' => 'Product edited.',
            'product' => $product
        ],200);


    }
    // Tìm Kiếm Sản Phẩm Theo từng Thể Loại
    public function search_product_by_category(Request $request)
    {
        $attrs = $request->validate([
            'category_id' => 'string|required',
        ]);
        $product = Product::where('category_id',$request->category_id)->get();
        return response([
            'message' => '200',
            'list_product' => $product
        ],200);
    }

    //Search Product Tìm Kiếm Sản Phẩm Trên Thanh Search trong giao diện Đặt Món
    public function search_product(Request $request)
    {
        $query = $request->search;
        $product = Product::where('title', 'LIKE', "%{$query}%")->get();
        return response([
            'message' => '200',
            'list_product' => $product
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
        //
    }
}
