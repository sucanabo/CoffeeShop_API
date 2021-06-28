<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
        //Register user
        public function register(Request $request)
        {
            //validate fields
            $attrs = $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'phone' => 'required',
                'username' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed'
            ]);
    
            //create user
            $user = User::create([
                'first_name' => $attrs['first_name'],
                'last_name'=> $attrs['last_name'],
                'phone'=> $attrs['phone'],
                'email'=> $attrs['email'],
                'username' => $attrs['username'],
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
                'email' => 'required|email',
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
                'first_name' => 'string',
                'last_name' => 'string',
                'email' =>'string',
                'phone' => 'string|min:11'
            ]);
    
            $image = $this->saveImage($request->image, 'profiles');
    
            auth()->user()->update([
                'name' => $attrs['name'],
                'image' => $image
            ]);
    
            return response([
                'message' => 'User updated.',
                'user' => auth()->user()
            ], 200);
        }
}
