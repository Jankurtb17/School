<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use App\exam;
class ViewSubjectLoad extends Controller
{ 
    
    
  public function index()
  {
    $advisory = DB::table('advisories')
                    ->where('employee_id', Auth()->user()->employee_id)
                    // ->groupBy('gradeLevel')
                    ->get();
    $start = Carbon::now('Asia/Taipei')->setTime(0, 0, 0);
    $end = Carbon::now('Asia/Taipei')->setTime(23, 59, 59);
    $examdate = DB::table('exams')->get();
    return view('teacher.subjectload', compact('advisory', 'examdate', 'start', 'end'));
  }

}
