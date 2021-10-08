<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
     //get user address
     public function addresses(){
        return response([
            'message'=>'success',
            'addresses'=> Address::where('user_id',auth()->user()->id)->get()
        ],200);
    }
    //add new user address => post
    public function create(Request $request){
        $attrs = $request->validate([
            'title' => 'string|required',
            'address' => 'string|required',
            'receiver_name' => 'string|required',
            'receiver_phone' => 'string|required',
        ]);
        $address = Address::create([
            'user_id'=>auth()->user()->id,
            'title'=> $request['title'],
            'address'=>$request['address'],
            'description'=>$request['description'],
            'coordinates'=>$request['coordinates'],
            'receiver_name'=>$request['receiver_name'],
            'receiver_phone'=>$request['receiver_phone']
        ]);
        return response(['message'=>'create address success.','address'=>$address],200);
    }
    //edit user address => put method
    public function edit(Request $request,$id)
    {
        $address = Address::find($id);
        if($address == null){
            response(['message'=>'Address not found.'],403);
        }
        $attrs = $request->validate([
            'title' => 'string|required',
            'address' => 'string|required',
            'receiver_name' => 'string|required',
            'receiver_phone' => 'string|required',
        ]);
        $address->update($request->all());
        return response(['message'=>'update address success.','addess'=>$address],200);
        
    }
    //delete user address => delete method
    public function delete($id){
        $address = Address::find($id);
        if($address == null){
            response(['message'=>'Address not found.'],403);
        }
        $address->delete();
        return response(['message'=>'delete address success.'],200);
    }
}
