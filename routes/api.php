<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavourateController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StatusController;
use App\Models\Order;
use App\Models\Report;

use function PHPSTORM_META\type;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('registerA',[AuthController::class,'registerAdmin']);
Route::post('registerP',[AuthController::class,'registerPharmacist']);
Route::post('login',[AuthController::class,'login']);



Route::middleware('auth:api')->group(function(){

    Route::post('medicine',[MedicineController::class,'AddMedicine'])->middleware('Admin');
    Route::get('logout',[AuthController::class,'logout']);
    Route::get('medicine/show/{id}',[MedicineController::class,'showMedicine']);
    Route::get('search/{name}',[SearchController::class,'searchbyname']);
    Route::get('searchbycategory/{name}',[SearchController::class,'searchbycategory']);
   Route::get('index',[SearchController::class,'index']);
    Route::get('select/{id}',[SearchController::class,'selectmed'])->name('medicine.select');
    Route::post('createorder',[OrderController::class,'orderMedicine']);
    Route::post('addorder',[OrderController::class,'AddOrder'])->middleware('Pharmacist');
    Route::get('showorder',[OrderController::class,'getOrders'])->middleware('Pharmacist');
    Route::get('showallorder',[StatusController::class,'getAllOrders'])->middleware('Admin');
    Route::post('updatestatus/{status_id}/{newstatus_id}',[StatusController::class,'updateOrderStatus'])->name('updatestatus')->middleware('Admin');
    Route::post('updatepayment/{odrerid,newPaymentStatus}',[StatusController::class,'updatePaymentStatus'])->middleware('Admin');
Route::get('getFavourate',[FavourateController::class,'get_favourate'])->middleware('Pharmacist');
Route::post('addFavourate',[FavourateController::class,'add_favourate'])->middleware('Pharmacist');
Route::post('addFavourate/{medicineId}',[FavourateController::class,'addToFavorites'])->middleware('Pharmacist');
Route::post('addreport/{type}',[ReportController::class,'makeReport']);
Route::post('/orders/{orderId}/update-status',[StatusController::class,'update_status'])->middleware('Admin');
Route::post('processorder/{order_id}',[StatusController::class,'processOrder'])->middleware('Admin');
Route::post('makereport',[ReportController::class,'makeReport']);


});