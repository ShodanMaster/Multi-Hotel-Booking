<?php

use App\Http\Controllers\Hotel\HotelController;
use Illuminate\Support\Facades\Route;

Route::prefix('hotel')->name('hotel.')->group(function(){
    Route::get('', [HotelController::class, 'index'])->name('index');
});
