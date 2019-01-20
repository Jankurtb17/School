<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\search_subjects;

class ListSubject extends Controller
{
    public function index()
    {
      $subject = DB::table('search_subjects')
                    ->where('gradeLevel', Auth()->user()->gradeLevel)
                    ->get();
        return view('student.dashboard', compact('subject'));
    }
}
