<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\search_subjects;

class ListSubject extends Controller
{
    public function index()
    {
      $subjects = DB::table('search_subjects')
                    ->where('gradeLevel', Auth()->user()->gradeLevel)
                    ->orderBy('subjectCode', 'ASC')
                    ->get();
        return view('student.listsubject', compact('subjects'));
    }
}
