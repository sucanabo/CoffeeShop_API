<?php



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\CategoryController;

use App\Http\Controllers\RatingController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\FavouriteController;

use App\Http\Controllers\UserVoucherController;

use App\Http\Controllers\VoucherController;

use App\Http\Controllers\RewardController;

use App\Http\Controllers\AddressController;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionController;



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
Route::post('/check_phone', [AuthController::class, 'checkPhone']);
Route::post('/check_email', [AuthController::class, 'checkEmail']);
Route::post('/login', [AuthController::class, 'login']);



//Protected routes

Route::group(['middleware' => ['auth:sanctum']], function() {

    // User

    Route::get('/user', [AuthController::class, 'user']);

    Route::post('/user/edit', [AuthController::class, 'edit']);

    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::post('/user/changepassword', [AuthController::class, 'changePassword']);




    // Product

    Route::get('/products',[ProductController::class,'index']); //all product

    Route::get('/products/{id}',[ProductController::class,'show']); //get single product

    Route::post('/products/condition',[ProductController::class,'condition']); //get other product by condition

    Route::post('/products',[ProductController::class,'create']); //create product

    Route::put('/products/{id}', [ProductController::class, 'edit']); // update product

    Route::delete('/products/{id}', [ProductController::class, 'destroy']); // delete product



    // Category

    Route::get('/categories',[CategoryController::class,'index']); //all category

    Route::get('/categories/{id}',[CategoryController::class,'show']); //show category 

    Route::post('/categories',[CategoryController::class,'create']); //create category 


    //Rating

    Route::get('/products/{id}/ratings',[RatingController::class,'index']); //get all rating

    Route::post('/products/{id}/ratings',[RatingController::class,'ratedOrNot']); //get all rating/ update rating

    

    //Favourite

    Route::post('/products/{id}/favourites', [FavouriteController::class, 'checkFavourite']); //check user is favourited product

    

    //Voucher
    Route::get('/vouchers',[VoucherController::class,'index']);
    
    Route::get('/uservouchers',[UserVoucherController::class,'index']);

    Route::post('/uservouchers/{id}/save',[UserVoucherController::class,'saveVoucher']);

    Route::delete('/uservouchers/{id}/use', [UserVoucherController::class,'useVoucher']);

    //Reward

    Route::get('/rewards',[RewardController::class,'index']);

    //Address

    Route::get('/addresses', [AddressController::class, 'addresses']);

    Route::post('/addresses/create', [AddressController::class, 'create']);

    Route::put('/addresses/{id}/edit', [AddressController::class, 'edit']);

    Route::delete('/addresses/{id}/delete', [AddressController::class, 'delete']);

    //order
    Route::post('/orders', [OrderController::class, 'create']);
    Route::get('/orders/{id}/items', [OrderController::class, 'items']);
    //transaction
    Route::post('/transactions', [TransactionController::class, 'getPage']);
});