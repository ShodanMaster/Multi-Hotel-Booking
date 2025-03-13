<?php

use App\Http\Controllers\Hotel\HotelController;
use App\Http\Controllers\Hotel\HotelRegister;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:hotel')->prefix('hotel')->name('hotel.')->group(function(){
    Route::get('', [HotelController::class, 'index'])->name('index');

    Route::get('register', [HotelRegister::class, 'index'])->name('register');
    ROute::post('hotel-register', [HotelRegister::class, 'registerHotel'])->name('hotelregister');
});
