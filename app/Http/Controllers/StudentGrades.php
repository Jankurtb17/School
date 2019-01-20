<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\schoolyear;
use App\search_subjects;

class StudentGrades extends Controller
{
    public function index()
    {
      $schoolyear = schoolyear::all();
      return view('student.studentgrades', compact('schoolyear'));
    }

    public function showSubjects()
    {
      
      $data = DB::table('search_subjects')
                    ->where('gradeLevel', Auth()->user()->gradeLevel)
                    ->groupBy('gradeLevel')
                    ->get();
      foreach($data as $row)
      {
        
      }
    }
}
