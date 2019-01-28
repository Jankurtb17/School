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

    public function __construct() {
      $this->middleware('guest:teacher');
    }
    
    public function index()
    {
      return view('Teacher.dashboard');
    }

  }
