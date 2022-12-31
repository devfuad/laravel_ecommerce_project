<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    function checkout(){
        $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();
        $countries = Country::all();
        $cities = City::all();
        return view('frontend.checkout', [
            'carts' => $carts,
            'countries' => $countries,
            'cities' => $cities,
        ]);
    }


    function getCity(Request $request){

            $str = '<option value="">-- Select City --</option>';
           $cities = City::where('country_id', $request->country_id)->get();
           foreach($cities as $city){
            $str.='<option value="">' . $city->name . '</option>';
           }
           echo $str;

           

    }
}
