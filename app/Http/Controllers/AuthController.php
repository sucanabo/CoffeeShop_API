<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Address;
use DNS1D;
use Picqer;

class AuthController extends Controller

{
        
        
        

        //check phone
        public function checkPhone(Request $request){
            $attrs = $request->validate([
                'phone' => 'required',
            ]);
            $user = User::where('phone',$request['phone'])->first();
            if(!$user){
                return response(['message' => 'phone enable to resgister'], 403);
            }
            return response([
                'message'=>'phone already taken.'
            ],200);
        }
        //check email
        public function checkEmail(Request $request){
            $attrs = $request->validate([
                'email' => 'required',
            ]);
            $user = User::where('email',$request['email'])->first();
            if(!$user){
                return response(['message' => 'email enable to resgister'], 403);
            }
            return response([
                'message'=>'email already taken.'
            ],200);
        }
        //Register user

        // public function register(Request $request)

        // {
        //     //create user
        //     $barcode = DNS1D::getBarcodeHTML($request['phone_test'], 'PHARMA2T');
        //     return $barcode;
        //     $user = User::create([

        //         'display_name' => $attrs['display_name'],

        //         'phone'=> $attrs['phone'],

        //         'email'=> $attrs['email'],
                
        //         'birthday' => $attrs['birthday'],

        //         'password' => $attrs['password'] != null? bcrypt($attrs['password']):null

        //     ]);
        //     $user->bar_code = $barcode;
        //     $user->save();

    

        //     //return user & token in response

        //     return response([

        //         'user' => User::find($user->id),

        //         'token' => $user->createToken('secret')->plainTextToken

        //     ], 200);

        // }

    

        // login user

        public function login(Request $request)

        {
            
            $attrs = $request->validate([
                'method' => 'required'
            ]);

            if($request['method'] == 'phone'){
                //validate fields

            $attrs = $request->validate([

                'phone' => 'required',

                'password' => 'required|min:6'

            ]);

            // attempt login

            if(!Auth::attempt($attrs)){

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
            else if($request['method'] == 'email'){
                //check email
                $user = User::where('email',$request['email'])->first();
                if(!$user){
                    return response([
                        'message' => 'Invalid credentials.'
                    ],401);
                }
                $token = $user->createToken('secret')->plainTextToken;
                return response(['user'=> $user, 'token' => $token],200);
            }

            

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

        public function edit(Request $request){
            auth()->user()->update($request->all());   
            return response(['message'=>'update user success.','user'=>$request->all()],200);
           
        }
        //change password
        public function changePassword(Request $request){
       
            $attrs = $request->validate(['password'=>'required']);
            $user = auth()->user();

            if(!$user){
                return response(['message' => 'user not found.'],403);
            }
            $newPass = bcrypt($attrs['password']);
            if($newPass == $user->password){
                $user->password = $newPass;
                $user->save();
                return response(['message' => 'resset password success.',$user],200);
            }
            return response(['message'=>'Wrong password.'],400);
           
        }


    

        

       

}

