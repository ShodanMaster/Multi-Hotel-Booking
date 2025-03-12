<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;

class HotelController extends Controller
{
    public function index(){
        return view('hotel.index');
    }
}
