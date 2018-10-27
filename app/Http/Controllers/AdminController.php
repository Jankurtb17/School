<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:User');
    }

    // Show admin dashboard
    public function index()
    {
      return view('login.admin');
    }
}
