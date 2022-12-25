<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    function coupon()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.coupon', [
            'coupons' => $coupons,
        ]);
    }

    function coupon_store(Request $request)
    {
        Coupon::Insert([
            'coupon_code' => $request->coupon_code,
            'type' => $request->type,
            'amount' => $request->amount,
            'validity' => $request->validity,
            'created_at' => Carbon::now(),

        ]);

        return back()->with('coupon_success', 'Coupon added successfully');
    }

    function coupon_delete($coupon_id)
    {
        Coupon::find($coupon_id)->delete();
        return back();
    }
}
