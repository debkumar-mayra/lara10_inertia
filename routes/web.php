<?php

use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class,'index']);
Route::get('/about', [HomeController::class,'about']);
Route::get('/test', [HomeController::class,'test'])->middleware('auth');
Route::get('/login', [HomeController::class,'login'])->name('frontend.login');
Route::post('/login', [HomeController::class,'authenticate'])->name('frontend.login');
Route::get('/dashboard', [HomeController::class,'dashboard'])->middleware('auth');
Route::get('/profile', [HomeController::class,'profile'])->middleware('auth');
Route::post('/logout', [HomeController::class,'logout'])->middleware('auth');

include('admin.php');
