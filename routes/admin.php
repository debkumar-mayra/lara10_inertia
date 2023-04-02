<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;


Route::redirect('/admin', 'admin/login');

Route::group(['prefix' => 'admin'], function () {
Route::get('login', [HomeController::class,'index']);
Route::post('login', [HomeController::class,'authenticate'])->name('login');

Route::group(['middleware' => ['auth', 'isAdmin']], function () {
    Route::get('dashboard', [HomeController::class,'dashboard']);
    Route::post('logout', [HomeController::class,'logout']);
    Route::get('users', [UserController::class,'userlist'])->name('admin.users');
    Route::any('create-user', [UserController::class,'createUser'])->name('admin.createUser');
    Route::any('edit-user/{id}', [UserController::class,'editUser'])->name('admin.editUser');
    Route::delete('delete-user/{id}', [UserController::class,'deleteUser'])->name('user.delete');
    Route::post('change-user-status', [UserController::class,'changeUserStatus'])->name('user.changeUserStatus');
    

});


});



