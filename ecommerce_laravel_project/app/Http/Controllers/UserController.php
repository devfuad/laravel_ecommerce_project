<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Name;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;




class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    function users()
    {
        // $users= User::all();
        $users = User::where('id', '!=', Auth::id())->get();
        $total_user = User::count();
        return view('admin.users.user', compact('users', 'total_user'));
    }


    function delete($user_id)
    {
        User::find($user_id)->delete();
        return back();
    }

    function profile()
    {
        return view('admin.users.profile');
    }

    function name_update(Request $request)
    {
        User::find(Auth::id())->update([
            'name' => $request->name,
        ]);

        return back();
    }

    function pass_update(Request $request)
    {
        $request->validate(
            [
                'old_password' => 'required',
                'password' => Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
                'password' => 'required|confirmed',
                'password_confirmation' => 'required'
            ],
            [
                'old_password.required' => 'Old Pass faka ken',
                'password.required' => 'New pass faka ken',
                'password.confirmed' => 'New ar Confirm pass same de',
                'password_confirmation.required' => 'Confirm pass faka ken',
            ]
        );

        if (Hash::check($request->old_password, Auth::user()->password)) {
            User::find(Auth::id())->update([
                'password'=>bcrypt($request->password),
            ]);
            return back()->with('success', 'Password Updated!!');
        }
        else{
            return back()->with('wrong_pass', 'Old Password Does Not Match!!');
        }
    }

    function photo_update(Request $request){


        $user_image = request()->photo_update;
        $extension = $user_image->getClientOriginalExtension();

        $after_replace = str_replace(' ', '-', Auth::user()->name);

        $file_name= Str::lower($after_replace . '-' . rand(100000, 199999) . '.' . $extension);

        Image::make($user_image)->save(public_path('uploads/user/' . $file_name));

        User::find(Auth::id())->update([
            'image'=>$file_name,
        ]);


        return back()->with('imagesuccess', 'Image added successfully');
        
    }
}
