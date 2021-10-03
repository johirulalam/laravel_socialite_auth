<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/list', [App\Http\Controllers\GuestController::class, 'userlist'])->name('user.list');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Admin User Profile Edit 
Route::get('admin/user/profile/edit/{email}', [App\Http\Controllers\UserController::class, 'EditProfileByAdmin'])->name('admin.edit.user');
Route::post('admin/user/profile/edit/{email}', [App\Http\Controllers\UserController::class, 'UpdateProfileByAdmin']);

//User Profile Edit
Route::get('/user/profile/edit', [App\Http\Controllers\UserController::class, 'EditProfile'])->name('user.edit');
Route::post('/user/profile/edit', [App\Http\Controllers\UserController::class, 'UpdateProfile']);

//User Profile 
Route::get('/user/profile', [App\Http\Controllers\UserController::class, 'UserProfile'])->name('user.profile');

// Facebook login
Route::get('login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);

