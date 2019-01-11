<?php

namespace App\Repositories;
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

use App\User;

class AuthController extends Controller
{
  use ThrottlesLogins;

  public function TeacherLogin() {
    if( Auth::check() ) {
      if( Auth::user()->role_id == 3) {
        return redirect('/teacher');
      }
    }
    else {
      return view('auth.login');
    }
  }

  public function TeacherLoginHandler(Request $request) {
    $this->validate($request, [
        'email'   =>  'required',
        'password'   =>  'required',
    ]); 

    $email = $request['email'];
    $password = $request['password'];

    if($this->hasTooManyLoginAttempts($request)){
			$this->fireLockoutEvent($request);
			return $this->sendLockoutResponse($request);
    }
    
    if(Auth::attempt(['email'=> $email, 'password'=> $password ])) {
      $request->session()->regenerate();
      $this->clearLoginAttempts($request);

      if(Auth::user()->role_id == 3 ){
        return redirect()->intended('Teacher/main');
      }
    }
    else {
      $this->incrementLoginAttempts($request);
      return redirect('/teacherLogin')->with(['email'=> Lang::get('auth.failed')]);
    }
  }
}
