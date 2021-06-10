<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function Hotelpage()
    {
        return view('hotel');
    }

    public function store(Request $request) { 

        if($request->file('image'))
    	{
    		$file = $request->file('image');
    		$image_name = rand(10000,99999).".".$file->getClientOriginalExtension();
    		$file->move(public_path('admin/images/'),$image_name);
    	}

        $Hotel = new Hotel;

        $Hotel->hotel_name = $request->hotelname;
        $Hotel->hotel_type = $request->hoteltype;
        $Hotel->country = $request->country;
        $Hotel->state = $request->state;
        $Hotel->city = $request->city;
        if($request != ''){
            $Hotel->accommodation = implode('-',$request->accommodation);
        }
        $Hotel->image = $image_name;
  
        $Hotel->save();
        
        return response()->json($Hotel);
  
      }
}
