<?php

namespace App\Http\Controllers;

use App\Models\Customerlogin;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function customer_profile()
    {
        return view('frontend.profile');
    }

    function customer_profile_update(Request $request)
    {
        if ($request->password == '') {
            if ($request->photo == '') {
                
            }
        } 
        else {
        }
    }
}
