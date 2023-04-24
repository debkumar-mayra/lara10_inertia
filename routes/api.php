<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('login', [AuthController::class,'login']);
Route::post('register', [AuthController::class,'register']);
Route::post('forgot-password', [AuthController::class,'forgotPassword']);
Route::post('otp-verify', [AuthController::class,'otpVerify']);


Route::middleware('auth:sanctum')->group(function(){
    Route::get('profile', [UserController::class,'profile']);
    Route::get('logout', [UserController::class, 'logout']);
});


