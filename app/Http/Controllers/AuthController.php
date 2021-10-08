<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Address;

class AuthController extends Controller
{
        //Register user
        public function register(Request $request)
        {
            //validate fields
            $attrs = $request->validate([
                'display_name' => 'required|string',
                'phone' => 'required|unique:users,phone',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed'
            ]);
    
            //create user
            $user = User::create([
                'display_name' => $attrs['display_name'],
                'phone'=> $attrs['phone'],
                'email'=> $attrs['email'],
                'password' => bcrypt($attrs['password'])
            ]);
    
            //return user & token in response
            return response([
                'user' => $user,
                'token' => $user->createToken('secret')->plainTextToken
            ], 200);
        }
    
        // login user
        public function login(Request $request)
        {
            //validate fields
            $attrs = $request->validate([
                'phone' => 'required',
                'password' => 'required|min:6'
            ]);
    
            // attempt login
            if(!Auth::attempt($attrs))
            {
                return response([
                    'message' => 'Invalid credentials.'
                ], 403);
            }
    
            //return user & token in response
            return response([
                'user' => auth()->user(),
                'token' => auth()->user()->createToken('secret')->plainTextToken
            ], 200);
        }
    
        // logout user
        public function logout()
        {
            auth()->user()->tokens()->delete();
            return response([
                'message' => 'Logout success.'
            ], 200);
        }
    
        // get user details
        public function user()
        {
            return response([
                'user' => auth()->user()
            ], 200);
        }

    
        // update user
        public function edit(Request $request)
        {
            $attrs = $request->validate([
                'display_name' => 'string',
                'image'=>'string',
                'email' =>'string|email',
                'phone' => 'string|min:11'
            ]);
            if($request['image'] != null){
                auth()->user()->image = $request['image'];
            }
            auth()->user()->update($request->all());
    
            return response([
                'message' => 'User updated.',
                'user' => auth()->user(),
            ], 200);
        }
       
}
