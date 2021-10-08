<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Favourite;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

     // Tích Điểm Tài Khoản , chức năng này được kích hoạt khi mình thanh toán thành công 
     public function accumulate_points()
     {
         $id = Auth::user()->id;
         $user = User::findOrFail($id);
         $user->point =  $user->point+10;
         if($user->save()){
             return response()->json([
                 'code'=> 200,
                 'message'=> 'Tích Điểm Thành Công'
             ],200);
         }
         else {
             return response()->json([
                 'code'=> 404,
                 'message'=> 'Tích Điểm Không Thành Công'
             ],200);
         }
        
     }



     // Thêm Món Ăn Yêu Thích 
     public function favourite(Request $request)
     {
        $id = Auth::user()->id;
        $favourite = new favourite();
        $favourite->user_id  = $id;
        $favourite->product_id = $request->product_id;
        if (favourite::where('user_id',$id)->Where('product_id',$request ->product_id)->delete()){
            return response()->json([
              'code'=> 200,
              'message'=> 'Đã Xóa Khỏi Danh Sách Yêu Thích'
          ],200);
        
    }
        else {
            $favourite->save();
            return response()->json([
                'code'=> 200,
                'message'=> 'Đã Thêm Vào Danh Sách  Yêu Thích'
            ],200);
        }
     }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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


     // Show Chi tiết thông tin của tài khoản người dùng đang đăng nhập 
    public function show()
    {
        //
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        return response()->json([
            'code'=> 200,
            'message'=> $user
        ],200);
    }

    // Update thông tin của tài khoản người dùng đang đăng nhập
    public function update_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|min:1|max:255',
            'last_name'=>'required|string|min:1|max:255',
            'gender'=>'required|string',
            'birthday'=>'required',
            'phone'=>'required|max:10',
            'email'=>'required|email',
        ]);

        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $password = Auth::user()->password;
        if ($password == $request->password){
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->gender = $request->gender;
            $user->birthday = $request->birthday;
            $user->phone = $request->phone;
            $user->image = $request->image;
            $user->email = $request->email;
            $user->password = $password;
            $user->save();
            return response()->json([
            
                'code'=> 200,
                'message'=> 'Cập Nhật Tài Khoản Thành Công 1'
            ],200);
        }
        else if ($request->password == null){
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->gender = $request->gender;
            $user->birthday = $request->birthday;
            $user->phone = $request->phone;
            $user->image = $request->image;
            $user->email = $request->email;
            $user->password =  $password;
            $user->save();
            return response()->json([
            
                'code'=> 200,
                'message'=> 'Cập Nhật Tài Khoản Thành Công 2'
            ],200);

        }
        else{
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->gender = $request->gender;
            $user->birthday = $request->birthday;
            $user->phone = $request->phone;
            $user->image = $request->image;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            return response()->json([
            
                'code'=> 200,
                'message'=> 'Cập Nhật Tài Khoản Thành Công 3'
            ],200);
        }
       
    }

     // Update Mật Khẩu của tài khoản người dùng đang đăng nhập
     public function update_Login(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
           
            'email'=>'required|email',
            'password'=>'required'
        ]);
       
        $id = Auth::user()->id;
        $password = Auth::user()->password;
        $user = User::findOrFail($id);     
        if ($password == $request->password){
            $user->email = $request->email;
            $user->password = $password;
            $user->save();
            return response()->json([
                'code'=> 200,
                'message'=> 'Cập Nhật Mật Khẩu Thành Công ',
                'data'=>$password
            ],200);
        }

        
        else {
            $user->email = $request->email;
            $user->password =  bcrypt($request->password);
            $user->save();
            return response()->json([
                'code'=> 200,
                'message'=> 'Cập Nhật Mật Khẩu Thành Công '
            ],200);
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


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
