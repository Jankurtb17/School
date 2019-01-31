<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubmittedGrades extends Controller
{
    public function index()
    {
        return view('teacher.submitted');
    }
}
