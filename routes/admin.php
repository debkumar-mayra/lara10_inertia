<?php
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;


Route::redirect('/admin', 'admin/login');

Route::group(['prefix' => 'admin'], function () {
Route::get('login', [HomeController::class,'index']);
Route::post('login', [HomeController::class,'authenticate'])->name('login');

Route::group(['middleware' => ['auth', 'isAdmin']], function () {
    Route::get('dashboard', [HomeController::class,'dashboard']);
    Route::post('logout', [HomeController::class,'logout']);
});


});



