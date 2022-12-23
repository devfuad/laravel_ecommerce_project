<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRegisterRequest;
use App\Models\Customerlogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CustomerRegisterController extends Controller
{
    function customer_store(CustomerRegisterRequest $request){
        Customerlogin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        if (Auth::guard('customerlogin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/')->with('success_login', 'Customer Registered Successfully!');;
        } 

    }
}
