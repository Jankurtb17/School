<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use DB;
class AccountSettings extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function showChangePasswordForm()
    {
      $teacher = DB::table('users')
              ->where('role_id', 3)
              ->count();
        $student = DB::table('users')
              ->where('role_id', 1)
              ->count();
      return view('auth.changepassword', compact('teacher', 'student'));    
    }

    public function changePassword(Request $request)
    {
      if(!Hash::check($request->get("current-password"), Auth()->user()->password)) {
        return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
      }

      if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
        //Current password and new password are same
        return redirect()->back()->with("error","New Password cannot be same as your current password");
    }

      $this->validate($request, [
          'current-password' => 'required',
          'new-password'     => 'required|string|min:6|confirmed'
      ]);

      $user = Auth::user();
      $user->password = bcrypt($request->get('new-password'));
      $user->save();
      return redirect()->back()->with("success","changed successfully !");
    }
   
}
