<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Protected routes
Route::group(['middleware' => ['auth:sanctum']], function() {
    // User
    Route::get('/user', [AuthController::class, 'user']);
    // Route::put('/user', [AuthController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Product
    Route::get('/products',[ProductController::class,'index']); //all product
    Route::get('/products/{id}',[ProductController::class,'show']); //get single product
    Route::post('/products',[ProductController::class,'create']); //create product
    Route::put('/products/{id}', [ProductController::class, 'edit']); // update post

    // Category
    Route::get('/categories',[CategoryController::class,'index']); //all category
    Route::get('/categories/{id}',[CategoryController::class,'show']); //show category 
    Route::post('/categories',[CategoryController::class,'create']); //create category 

    //Rating
    Route::get('/ratings',[RatingController::class,'index']); //get all rating
    Route::get('/ratings/{id}',[RatingController::class,'show']); //get single rating
    Route::post('/ratings',[RatingController::class,'create']); //create rating
    Route::put('/ratings/{id}', [RatingController::class, 'edit']); // update rating




    Route::get('/accumulate_points',[UserController::class,'accumulate_points']); // accumulate points
    Route::post('/favourite',[UserController::class,'favourite']); // favourites food
    Route::get('/show_favourite',[UserController::class,'show_favourite']); // favourites food
    Route::get('/show_detail_user',[UserController::class,'show']); // Detail User
    Route::post('/update_profile',[UserController::class,'update_profile']); // Update Profile (Update tổng thông tin khách hàng)
    Route::post('/update_Login',[UserController::class,'update_Login']); // Update Username,Email,Password (Trường hợp này nếu giao diện trang có phần đổi mật khẩu username riêng)
    Route::post('/search_product_by_category',[ProductController::class,'search_product_by_category']); // Search Category (Giúp Khách Hàng Chọn Món ở Mục Thực Đơn , của Đặt Món) 
    Route::get('/list_category',[CategoryController::class,'list_category']); // Search Category (Giúp Khách Hàng Chọn Món ở Mục Thực Đơn , của Đặt Món) 
    Route::post('/search_product',[ProductController::class,'search_product']); // Search Product (Giúp Khách Hàng Tìm Các Món Ăn Gần Đúng) 

});