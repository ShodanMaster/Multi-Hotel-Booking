<?php

use App\Http\Controllers\Hotel\HotelController;
use App\Http\Controllers\Hotel\HotelRegister;
use Illuminate\Support\Facades\Route;

Route::prefix('hotel')->name('hotel.')->group(function(){
    Route::get('register', [HotelRegister::class, 'index'])->name('register');
    Route::get('', [HotelController::class, 'index'])->name('index');
});
