<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLoginController extends Controller
{
    public function showLoginForm(){
      return view('Login.index');
    }
    protected function guard(){
      return Auth::guard('User');
    }
}
