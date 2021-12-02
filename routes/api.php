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
use App\Http\Controllers\Api\TicketExportController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Api\NewController;
use App\Http\Controllers\Api\RatingController;


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
Route::get('ticketexport', [TicketExportController::class, 'export']);
Route::resource('users', UserController::class);
Route::resource('news', NewController::class);

//Register
Route::post('register', [RegisterController::class , 'register']);

//Login
Route::post('login', [LoginController::class , 'login']);

Route::post('payment', [PaymentController::class , 'create']);
Route::get('vnpay/return', [PaymentController::class, 'vnpayReturn'])->name('vnpay.return');

Route::post('/sendmail', [MailController::class, "sendmail"]);

//api create rating
Route::post('buses/rating/{buses_id}', [BusesController::class , 'rating']);//lấy id của chuyến xe
//api delete
Route::resource('rating', RatingController::class);

//quản lý tài khoản

Route::resource('userAdmin', UserAdminController::class);

//quản lý role - permission
Route::resource('role', RolePermissionController::class);
//api permision
Route::resource('permission', PermissionController::class)->only('index');

