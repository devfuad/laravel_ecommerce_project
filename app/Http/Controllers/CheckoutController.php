<?php

namespace App\Http\Controllers;

use App\Models\BillingDetails;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class CheckoutController extends Controller
{
    function checkout()
    {
        $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();
        $countries = Country::all();
        $cities = City::all();
        return view('frontend.checkout', [
            'carts' => $carts,
            'countries' => $countries,
            'cities' => $cities,
        ]);
    }


    function getCity(Request $request)
    {

        $str = '<option value="">-- Select City --</option>';
        $cities = City::where('country_id', $request->country_id)->get();
        foreach ($cities as $city) {
            $str .= '<option value="' . $city->id . '">' . $city->name . '</option>';
        }
        echo $str;
    }

    function order_store(Request $request)
    {
        if ($request->payment_method == 1) {
            // $order_id = '#'.Str::Upper(Str::random(3)).'-'.rand(999999,100000);
            $order_id = '#' . 'CREATE' . '-' . rand(999999, 100000);
            Order::insert([
                'order_id' => $order_id,
                'customer_id' => Auth::guard('customerlogin')->id(),
                'subtotal' => $request->checkout_subtotal,
                'discount' => $request->discount,
                'charge' => $request->charge,
                'total' => $request->checkout_subtotal + $request->charge,
                'payment_method' => $request->payment_method,
                'created_at' => Carbon::now()
            ]);

            BillingDetails::insert([
                'order_id' => $order_id,
                'customer_id' => Auth::guard('customerlogin')->id(),
                'name' => $request->name,
                'email' => $request->email,
                'company' => $request->company,
                'phone' => $request->phone,
                'address' => $request->address,
                'zip' => $request->zip,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'notes' => $request->notes,
                'created_at' => Carbon::now(),

            ]);

            $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();

            foreach ($carts as $cart) {
                OrderProduct::insert([
                    'order_id' => $order_id,
                    'customer_id' => Auth::guard('customerlogin')->id(),
                    'product_id' => $cart->product_id,
                    'price' => $cart->rel_to_product->after_discount,
                    'color_id' => $cart->color_id,
                    'size_id' => $cart->size_id,
                    'quantity' => $cart->quantity,
                    'created_at' => Carbon::now()
                ]);

                Inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->decrement('quantity', $cart->quantity);
            }

            $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->delete();

            

            return back();
        } 
        elseif ($request->payment_method == 2) {
            echo "ssl";
        } 
        else {
            echo "stripe";
        }
    }
}
