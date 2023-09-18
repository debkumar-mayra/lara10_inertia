<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;





Route::get('/', [HomeController::class,'index']);
Route::get('/about', [HomeController::class,'about']);
Route::any('/test', [HomeController::class,'test']);
Route::get('/login', [HomeController::class,'login'])->name('frontend.login');
Route::post('/login', [HomeController::class,'authenticate'])->name('frontend.login');
Route::get('/dashboard', [HomeController::class,'dashboard'])->middleware(['auth','isUser']);
Route::get('/profile', [HomeController::class,'profile'])->middleware(['auth','isUser']);
Route::post('/logout', [HomeController::class,'logout'])->middleware(['auth','isUser']);
Route::post('social-login', [HomeController::class, 'socialLogin'])->name('socialLogin');