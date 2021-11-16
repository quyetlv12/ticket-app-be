<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BusesController;
use App\Http\Controllers\Api\CartypeController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PaymentController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('buses', BusesController::class);
Route::get('search', [BusesController::class , 'search']);
Route::resource('cartypes', CartypeController::class);
Route::resource('services', ServiceController::class);
Route::resource('ticket', TicketController::class);
Route::resource('users', UserController::class);
//Register
Route::post('register', [RegisterController::class , 'register']);

//Login
Route::post('login', [LoginController::class , 'login']);

Route::post('payment', [PaymentController::class , 'create']);
Route::get('vnpay/return', [PaymentController::class, 'vnpayReturn'])->name('vnpay.return');

