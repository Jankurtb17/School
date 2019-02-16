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
                    ->orderBy('subjectCode', 'ASC')
                    ->get();
      $grade2 = DB::table('search_subjects')
                    ->where('gradeLevel', 2)
                    ->orderBy('subjectCode', 'ASC')
                    ->get();
      $grade3 = DB::table('search_subjects')
                    ->where('gradeLevel', 3)
                    ->orderBy('subjectCode', 'ASC')
                    ->get();
      $grade4 = DB::table('search_subjects')
                    ->where('gradeLevel', 4)
                    ->orderBy('subjectCode', 'ASC')
                    ->get();
      $grade5 = DB::table('search_subjects')
                    ->where('gradeLevel', 5)
                    ->orderBy('subjectCode', 'ASC')
                    ->get();
      $grade6 = DB::table('search_subjects')
                    ->where('gradeLevel', 6)
                    ->orderBy('subjectCode', 'ASC')
                    ->get();
        return view('student.listsubject', compact('grade1', 'grade2', 'grade3', 'grade4', 'grade5', 'grade6'));
    }
}
