<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function(){
    Route::get('', [AdminController::class, 'index'])->name('index');

});

