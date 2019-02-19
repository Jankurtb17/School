<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class viewteacher extends Controller
{
   

    public function select($employee_id)
    {
      $teacher = DB::table('users')
                ->where('role_id', 3)
                ->count();
      $student = DB::table('users')
                ->where('role_id', 1)
                ->count();
      $schoolyear = DB::table('schoolyears')->get();
      $gradelevel = DB::table('advisories')
                  ->where('employee_id', $employee_id)
                  ->groupBy('gradeLevel')
                  ->get();
      $subjectCode = DB::table('advisories')
                  ->where('employee_id', $employee_id)
                  ->groupBy('subjectCode')
                  ->get();
      $user= DB::table('users')
                ->where('employee_id', $employee_id)
                ->get();
      // $grade = DB::table('users')
      //           ->join('sendgradeadmins', 'users.student_id', '=', 'sendgradeadmins.student_id')
      //           ->select('users.student_id','users.firstName', 'users.middleName', 'users.lastName')
      //           ->where('sendgradeadmins.employee_id', $employee_id)
      //           ->get();
        $grade = DB::table('sendgradeadmins')
                   ->join('users', 'sendgradeadmins.student_id', '=', 'users.student_id')
                   ->where('sendgradeadmins.employee_id', $employee_id)
                   ->orderBy('sendgradeadmins.gradelevel', 'ASC')
                   ->get();
      
       return view('Dashboard.viewteacher', compact('schoolyear','user', 'subjectCode','student', 'teacher', 'gradelevel', 'grade'));
    }

    
}
