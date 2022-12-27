<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function cart_store(Request $request)
    {
        // print_r($request->all());
        if (Auth::guard('customerlogin')->check()) {
            Cart::insert([
                'customer_id' => Auth::guard('customerlogin')->id(),
                'product_id' => $request->product_id,
                'size_id' => $request->size_id,
                'color_id' => $request->color_id,
                'quantity' => $request->quantity,
                'created_at' => Carbon::now(),
            ]);

            return back()->with('cart_added', 'Cart added successfully');
        } else {
            return redirect()->route('customer.register.login')->with('login', 'Please login to Add Cart!!');
        }
    }

    function remove_cart($cart_id)
    {
        Cart::find($cart_id)->delete();
        return back();
    }
    function clear_cart()
    {
        Cart::where('customer_id', Auth::guard('customerlogin')->id())->delete();
        return back();
    }

    function cart(Request $request)
    {
        $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();
        $coupon_code = $request->coupon;

        $discount = 0;
        $message = '';
        $type = '';
        $total = 0;
        

        if ($coupon_code == '') {
            $discount = 0;
        } else {
            if (Coupon::where('coupon_code', $coupon_code)->exists()) {
                if (Carbon::now()->format('Y-m-d') > Coupon::where('coupon_code', $coupon_code)->first()->validity) {
                    $discount = 0;
                    $message = 'Coupon code Expired';
                }
                else{
                    $discount = Coupon::where('coupon_code', $coupon_code)->first()->amount;
                    $type = Coupon::where('coupon_code', $coupon_code)->first()->type;
                }

            } 
            else {
                $discount = 0;
                $message = 'Invalid Coupon Code';
            }
        }


        return view('frontend.cart', [
            'carts' => $carts,
            'coupon_code' => $coupon_code,
            'discount' => $discount,
            'message' => $message,
            'type' => $type,
            'total' => $total,
        ]);
    }

    function update_cart(Request $request)
    {
        foreach ($request->quantity as $cart_id => $quantity) {
            Cart::find($cart_id)->update([
                'quantity' => $quantity
            ]);
        }
        return back();
    }
}
