<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HotelRegister extends Controller
{
    public function index(){
        return view('hotel.login.register');
    }

    public function registerHotel(Request $request){
        // dd($request->all());
        try{
            $validated = $request->validate([
                'name' => 'required|string|min:6',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:8'
            ]);

            $hotel = Hotel::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if($hotel && auth('hotel')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('hotel.index');
            }
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Something Went Wrong! '.$e->getMessage());
        }
    }
}
