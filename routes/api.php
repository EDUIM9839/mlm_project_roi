<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
 

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

 

Route::post('/login', [UserController::class, 'login_validate'])->name('login_validate');


Route::middleware('auth:sanctum')->get('user_list',[UserController::class, 'user_list'])->name('user_list');
Route::post('register',[UserController::class, 'register'])->name('register');
Route::post('forget_password', [UserController::class, 'forget_password'])->name('forget_password');
Route::post('verify_otp', [UserController::class, 'verify_otp'])->name('verify_otp');
Route::post('reset_password', [UserController::class, 'reset_password'])->name('reset_password');
Route::get('userdetail', [UserController::class, 'userdetail'])->name('userdetail ');
Route::get('activeinactiveuser' , [UserController::class, 'activeinactiveuser'])->name('activeinactiveuser');















