<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\UserController;


Route::redirect('/admin', 'admin/login');

Route::group(['prefix' => 'admin'], function () {
Route::get('login', [HomeController::class,'index']);
Route::post('login', [HomeController::class,'authenticate'])->name('login');

    Route::name('admin.')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [HomeController::class,'dashboard'])->name('dashboard');
    Route::any('admin-profile', [HomeController::class,'adminProfile'])->name('profile');
    Route::post('admin-change-password', [HomeController::class,'adminChangePassword'])->name('changePassword');
    
    Route::post('logout', [HomeController::class,'logout'])->name('logout');
    Route::get('users', [UserController::class,'userlist'])->name('users');
    Route::any('create-user', [UserController::class,'createUser'])->name('createUser');
    Route::any('edit-user/{id}', [UserController::class,'editUser'])->name('editUser');
    Route::delete('delete-user/{id}', [UserController::class,'deleteUser'])->name('userDelete');
    Route::post('change-user-status', [UserController::class,'changeUserStatus'])->name('changeUserStatus');

    Route::resource('faq', FaqController::class);  
    Route::post('change-faq-status', [FaqController::class,'changeFaqStatus']);

    Route::resource('cms', CmsController::class)->except(['update', 'show']);
    Route::post('cms/{slug}', [CmsController::class,'update']);  
    Route::any('setting', [SiteSettingController::class,'setting'])->name('setting');  


});


});



