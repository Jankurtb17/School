<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\search_subjects;

class ListSubject extends Controller
{
    public function index()
    {
      $grade1 = DB::table('search_subjects')
                    ->where('gradeLevel', 1)
                    ->get();
      $grade2 = DB::table('search_subjects')
      ->where('gradeLevel', 2)
                    ->get();
      $grade3 = DB::table('search_subjects')
                    ->where('gradeLevel', 3)
                    ->get();
        return view('student.listsubject', compact('grade1', 'grade2', 'grade3'));
    }
}
