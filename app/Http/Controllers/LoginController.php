<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Users;
use Auth;

class LoginController extends Controller
{ 
  public function index()
  {
    return view('Pages.Login');
  } 
  public function dashboard()
  {
    return view('Pages.dashboard');
  }
  function checkLogin(Request $request)
  {
      $this->validate($request, [
      'email'   => 'required|string|email',
      'password'=> 'required|min:6',
    ]); 

    $user_data = array(
      'email'   =>$request->get('email'),
      'password'=>$request->get('password')
    );

    if(Auth::attempt($user_data))
    {
      return redirect('/dashboard');
    }
    else
    {
      return back()->with('error', 'Email or password is incorrect');
    }
  }

}

