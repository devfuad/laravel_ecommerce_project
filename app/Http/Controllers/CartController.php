<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function cart_store(Request $request){
        // print_r($request->all());
        if (Auth::guard('customerlogin')->check()) {
            Cart::insert([
                'customer_id'=> Auth::guard('customerlogin')->id(),
                'product_id'=> $request->product_id,
                'size_id'=> $request->size_id,
                'color_id'=> $request->color_id,
                'quantity'=> $request->quantity,
                'created_at'=> Carbon::now(),
            ]);

            return back()->with('cart_added', 'Cart added successfully');
        } 
        else {
            return redirect()->route('customer.register.login')->with('login', 'Please login to Add Cart!!');
        }
    }

    function remove_cart($cart_id){
        Cart::find($cart_id)->delete();
        return back();

    }
    function clear_cart(){
        Cart::where('customer_id', Auth::guard('customerlogin')->id())->delete();
        return back();

    }
}
