<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentBalance extends Controller
{
    public function index() 
    {
      return view('student.balance');
    }
}
