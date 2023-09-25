<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SocialController;





Route::get('/', [HomeController::class,'index']);
Route::get('/about', [HomeController::class,'about']);
Route::any('/test', [HomeController::class,'test']);
Route::get('/login', [HomeController::class,'login'])->name('frontend.login');
Route::post('/login', [HomeController::class,'authenticate'])->name('frontend.login');
Route::get('/dashboard', [HomeController::class,'dashboard'])->middleware(['auth','isUser']);
Route::get('/profile', [HomeController::class,'profile'])->middleware(['auth','isUser']);
Route::post('/logout', [HomeController::class,'logout'])->middleware(['auth','isUser']);

Route::get('auth/google', [SocialController::class, 'redirectToGoogle'])->name('googleLogin');
Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [SocialController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [SocialController::class, 'handleFacebookCallback']);