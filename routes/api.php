<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RatingController;
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
    Route::get('/categories/{id}',[CategoryController::class,'show']); //all category 
    Route::post('/categories',[CategoryController::class,'create']); //all category 

    //Rating
    Route::get('/ratings',[RatingController::class,'index']); //get all rating
    Route::get('/ratings/{id}',[RatingController::class,'show']); //get single rating
    Route::post('/ratings',[RatingController::class,'create']); //create rating
    Route::put('/ratings/{id}', [RatingController::class, 'edit']); // update rating
});