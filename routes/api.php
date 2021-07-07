<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\FavouriteController;
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

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Protected routes
Route::group(['middleware' => ['auth:sanctum']], function() {
    // User
    Route::get('/user', [AuthController::class, 'user']);
    Route::put('/user', [AuthController::class, 'edit']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Product
    Route::get('/products',[ProductController::class,'index']); //all product
    Route::get('/products/{id}',[ProductController::class,'show']); //get single product
    Route::post('/products/condition',[ProductController::class,'condition']); //get other product by condition
    Route::post('/products',[ProductController::class,'create']); //create product
    Route::put('/products/{id}', [ProductController::class, 'edit']); // update product
    Route::delete('/products/{id}', [ProductController::class, 'destroy']); // delete product

    // Category
    Route::get('/categories',[CategoryController::class,'index']); //all category
    Route::get('/categories/{id}',[CategoryController::class,'show']); //all category 
    Route::post('/categories',[CategoryController::class,'create']); //all category 

    //Rating
    Route::get('/products/{id}/ratings',[RatingController::class,'index']); //get all rating
    Route::post('/products/{id}/ratings',[RatingController::class,'ratedOrNot']); //get all rating/ update rating
    
    //Favourite
    Route::post('/products/{id}/favourites', [FavouriteController::class, 'checkFavourite']); //check user is favourited product
    
    //Option
    
});