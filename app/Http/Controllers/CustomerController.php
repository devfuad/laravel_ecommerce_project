<?php

namespace App\Http\Controllers;

use App\Models\Customerlogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

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

                Customerlogin::find(Auth::guard('customerlogin')->id())->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'country' => $request->country,
                    'address' => $request->address,
                ]);
            } 
            else {

                if(Auth::guard('customerlogin')->user()->photo != null){
                    $delete_from = public_path('/uploads/customer/' .Auth::guard('customerlogin')->user()->photo);
                    unlink($delete_from);
                }

                $uploaded_file = $request->photo;
                $extension = $uploaded_file->getClientOriginalExtension();
                $file_name = Auth::guard('customerlogin')->id() . '.' . $extension;
                Image::make($uploaded_file)->resize(623, 800)->save(public_path('uploads/customer/' . $file_name));

                Customerlogin::find(Auth::guard('customerlogin')->id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'country'=>$request->country,
                    'address'=>$request->address,
                    'photo'=>$file_name,      
                ]);

                
            }
        } 
        else {
            
            if (Hash::check($request->old_password, Auth::guard('customerlogin')->user()->password)) {
                Customerlogin::find(Auth::guard('customerlogin')->id())->update([
                    'password'=>bcrypt($request->password),
                ]);

                if ($request->photo == '') {

                    Customerlogin::find(Auth::guard('customerlogin')->id())->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'country' => $request->country,
                        'address' => $request->address,
                        'password' => bcrypt($request->password),
                    ]);
                } 
                else {
    
                    if(Auth::guard('customerlogin')->user()->photo != null){
                        $delete_from = public_path('/uploads/customer/' .Auth::guard('customerlogin')->user()->photo);
                        unlink($delete_from);
                    }
    
                    $uploaded_file = $request->photo;
                    $extension = $uploaded_file->getClientOriginalExtension();
                    $file_name = Auth::guard('customerlogin')->id() . '.' . $extension;
                    Image::make($uploaded_file)->resize(623, 800)->save(public_path('uploads/customer/' . $file_name));
    
                    Customerlogin::find(Auth::guard('customerlogin')->id())->update([
                        'name'=>$request->name,
                        'email'=>$request->email,
                        'country'=>$request->country,
                        'address'=>$request->address,
                        'photo'=>$file_name,
                        'password' => bcrypt($request->password),      
                    ]);
    
                    
                }
            }
            else{

                if ($request->photo == '') {

                    Customerlogin::find(Auth::guard('customerlogin')->id())->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'country' => $request->country,
                        'address' => $request->address,
                        
                    ]);
                } 
                else {
    
                    if(Auth::guard('customerlogin')->user()->photo != null){
                        $delete_from = public_path('/uploads/customer/' .Auth::guard('customerlogin')->user()->photo);
                        unlink($delete_from);
                    }
    
                    $uploaded_file = $request->photo;
                    $extension = $uploaded_file->getClientOriginalExtension();
                    $file_name = Auth::guard('customerlogin')->id() . '.' . $extension;
                    Image::make($uploaded_file)->resize(623, 800)->save(public_path('uploads/customer/' . $file_name));
    
                    Customerlogin::find(Auth::guard('customerlogin')->id())->update([
                        'name'=>$request->name,
                        'email'=>$request->email,
                        'country'=>$request->country,
                        'address'=>$request->address,
                        'photo'=>$file_name,
                            
                    ]);
    
                    
                }
                return back()->with('wrong_pass', 'Old Password Does Not Match!!');
            }

           
        }

        return back()->with('s_update', 'Successfully updated!');
    }


    function customer_order(){
        return view()
    }
}
