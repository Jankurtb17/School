<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
      return view('Login.index');
    }
    protected function guard()
    {
      return Auth::guard('admin');
    }
    protected $redirectTo = '/home';

    public function __construct()
    {
      $this->middleware('guest:admin')->except('logout');
    }
}
