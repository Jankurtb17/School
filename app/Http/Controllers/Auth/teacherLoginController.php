<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Auth;
use App\teacher;

class teacherLoginController extends Controller
{
    //
    use AuthenticatesUsers;

    public function __construct() {
      $this->middleware('guest:teacher');
    }

    public function showLoginForm()
    {
      return view('auth.teacher-login');
    }

    public function login(Request $request)
    {
      // validate form data
      $this->validate($request, [
        'email'       => 'required|email',
        'password'    => 'required|min:6',
      ]);

      //attempt to login the teacher in
       if (Auth::guard('teacher')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
           return redirect()->intended(route('teacher.dashboard'));
       }
      //if successfully then redirect to their intended location
       return redirect()->back()
                    ->withInput($request->only('email', 'remember'))
                    ->withErrors(['email'=> Lang::get('auth.failed')]);

      // if iunsuccessful then redirect back to the login with the form data 
    }


  }
