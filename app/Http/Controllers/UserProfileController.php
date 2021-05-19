<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;


class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changePassword ()
    {
        return view('admin.user_profile.index');
    }

    public function updatePassword (Request $request)
    {
        $validate = $request->validate([
            'current_password' => 'required',
            'password' =>'required|confirmed'

        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->current_password, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            return redirect()->route('login')->with('success', 'Your password has been updated.');

        } else {
            return redirect()->back()->with('error', 'Current Password is invalid');
        }

    }
}
