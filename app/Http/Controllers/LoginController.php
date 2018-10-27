<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

class LoginController extends Controller
{
    function index()
    {
      return view('Pages.Login');
    }
    function checkLogin(Request $request)
    {
      $this->validate($request, [
        'email'    => 'required|email',
        'password' => 'required|alphaNum|min:5'
      ]);
      
      $user_data = array(
        'email'    => $request->get('email'),
        'password' => $request->get('password')
      );

      if(Auth::attempt($user_data))
      {
        return redirect('/login/successLogin');  
      }
      else{
        return back()->with('error', 'Username or password is incorrect');
      }

    }
    function successLogin()
    {
      return view('login.success');
    }

    function logout()
    {
      Auth::logout();
      return redirect('/');
    }

    function failedLogin()
    {
      return view('Pages.Login');
    }

}

