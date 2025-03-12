<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
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

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('logging-in', [LoginController::class, 'loggingIn'])->name('loggingin');
Route::post('register-user', [LoginController::class, 'registerUser'])->name('registeruser');
Route::post('logging-out', [LoginController::class, 'loggingOut'])->name('loggingout');

Route::post('password-change', [LoginController::class, 'passwordChange'])->name('passwordchange');
Route::get('change-password', [LoginController::class, 'changePassword'])->name('changepassword');

Route::get('/', [IndexController::class, 'index'])->name('index');
