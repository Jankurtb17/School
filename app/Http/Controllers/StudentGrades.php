<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\schoolyear;
use App\search_subjects;
use DB;

class StudentGrades extends Controller
{
    public function index()
    {
      $schoolyear = schoolyear::all();
      return view('student.studentgrades', compact('schoolyear'));
    }

    public function showGrades(Request $request)
    {
      $output = '';
      $gradingperiod = $request->get('gradingPeriod');
      $schoolyear = $request->get('schoolYear');
      $search = DB::table('firstgradings')
                  ->join('search_subjects', 'firstgradings.subjectCode', '=', 'search_subjects.subjectCode')
                  ->join('users', 'firstgradings.employee_id', '=', 'users.employee_id')
                  // ->select('search_subjects.subjectCode, search_subjects.description, firstgradings.schoolYear, 
                  // firstgradings.gradingperiod, firstgradings.student_id, users.employee_id')
                  ->where('firstgradings.gradingperiod', $gradingperiod)
                  ->where('firstgradings.schoolYear', $schoolyear)
                  ->where('firstgradings.student_id', Auth()->user()->student_id)
                  ->groupBy('firstgradings.subjectCode')
                  ->get();
      $count = count($search);
      if($count > 0)
      {
          foreach($search as $row)
          {
            $output .= '
                
                  <tr>
                    <td colspan="2">'.$row->subjectCode.'</td>
                    <td colspan="2">'.$row->description.'</td>
                    <td colspan="2">'.$row->employee_id.'</td>
                    <td>'.$row->grade.'</td>
                  </tr>
                  ';
          }
          return response()->json($output);
      }
      else {
        $output = '<tr> <td colspan="5">No results were found </td> </tr>';
        return response()->json($output);
      }
    }
}
