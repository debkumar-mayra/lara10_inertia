<?php

use Illuminate\Support\Facades\Route;
// use Intervention\Image\Facades\Image;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\Frontend\HomeController;

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

Route::get('/video-call', function(){
    return view('video_call');
});


Route::get('/', [HomeController::class,'index']);
Route::get('/about', [HomeController::class,'about']);
Route::any('/test', [HomeController::class,'test']);
Route::get('/login', [HomeController::class,'login'])->name('frontend.login');
Route::post('/login', [HomeController::class,'authenticate'])->name('frontend.login');
Route::get('/dashboard', [HomeController::class,'dashboard'])->middleware(['auth','isUser']);
Route::get('/profile', [HomeController::class,'profile'])->middleware(['auth','isUser']);
Route::post('/logout', [HomeController::class,'logout'])->middleware(['auth','isUser']);

Route::any('/forgot-password', [CommonController::class,'forgotPassword'])->name('frontend.forgotPassword');
Route::any('/otp-validations', [CommonController::class,'otpValidations'])->name('frontend.otpValidations');
Route::any('/reset-password', [CommonController::class,'resetPassword'])->name('frontend.resetPassword');

// Route::get('/image', function() {
//     set_time_limit(0);
//     return $img = Image::make('abc.png')->resize(50, 50)->response('jpg');
// });

// Images
Route::get('/img/{path}', [ImagesController::class, 'show'])
    ->where('path', '.*')
    ->name('image');

include('admin.php');
include('artisan.php');
