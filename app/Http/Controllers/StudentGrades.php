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
      $search = DB::table('sendgradeadmins')
                  ->join('search_subjects', 'sendgradeadmins.subjectCode', '=', 'search_subjects.subjectCode')
                  ->join('users', 'sendgradeadmins.employee_id', '=', 'users.employee_id')
                  ->select('search_subjects.subjectCode', 'search_subjects.description', 'users.firstName', 'users.lastName', 'users.middleName','sendgradeadmins.grade')
                  ->where('sendgradeadmins.gradingperiod', $gradingperiod)
                  ->where('sendgradeadmins.schoolYear', $schoolyear)
                  ->where('sendgradeadmins.student_id', Auth()->user()->student_id)
                  ->groupBy('sendgradeadmins.subjectCode')
                  ->get();
      $count = count($search);
      if($count > 0)
      {
          foreach($search as $row)
          {
            $grade = $row->grade;
            if($grade >= 75){
                $output .= '
                      <tr>
                        <td colspan="2">'.$row->subjectCode.'</td>
                        <td colspan="2">'.$row->description.'</td>
                        <td colspan="2">'.$row->firstName.' '.$row->middleName.' '.$row->lastName.'</td>
                        <td>'.$row->grade.'</td>
                        <td> <span class="badge badge-success"> Passed </span> </td>
                      </tr>';
              }
              else {
                $output .= '
                      <tr>
                        <td colspan="2">'.$row->subjectCode.'</td>
                        <td colspan="2">'.$row->description.'</td>
                        <td colspan="2">'.$row->firstName.' '.$row->middleName.' '.$row->lastName.'</td>
                        <td>'.$row->grade.'</td>
                        <td><span class="badge badge-danger"> Failed </span> </td>
                      </tr>';
                    }
              }
                  return response()->json($output);
      
      }
      else {
        $output = '<tr> <td colspan="5">No grades were found </td> </tr>';
        return response()->json($output);
      }
    }
}
