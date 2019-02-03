<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SubmittedGrades extends Controller
{
    public function index()
    {
      $advisory = DB::table('advisories')
                    ->where('employee_id', Auth()->user()->employee_id)
                    ->groupBy('gradeLevel')
                    ->get();
        return view('teacher.submitted', compact('advisory'));
    }

    public function fetch(Request $request)
    {
      $select = $request->get('select');
      $value = $request->get('value');
      $dependent = $request->get('dependent');
      $data = DB::table('advisories')
                ->where($select, $value)
                ->where('employee_id', Auth()->user()->employee_id)
                ->groupBy($dependent)
                ->get();
     $output = '<option value="" selected disabled>-Select Subject Code-</option>';
     foreach($data as $row)
     {
       $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
     }
     echo $output;
    }

    public function search(Request $request)
    {
      $gradingperiod = $request->get('gradingperiod');
      $gradeLevel    = $request->get('gradeLevel');
      $subjectCode   = $request->get('subjectCode');
      $output = '';
      $data = DB::table('firstgradings')
                ->join('users','firstgradings.student_id', '=', 'users.student_id')
                ->where('users.gradeLevel', $gradeLevel)
                ->where('firstgradings.gradingperiod', $gradingperiod)
                ->where('firstgradings.subjectCode', $subjectCode)
                ->where('firstgradings.employee_id', Auth()->user()->employee_id)
                ->groupBy('firstgradings.student_id')
                ->get();
      $total_rows = $data->count();
      if($total_rows > 0)
      {
          foreach($data as $row)
          {
            $output .= '
                    <tr>
                      <td>'.$row->student_id.'</td>
                      <td>'.$row->firstName.'</td>
                      <td>'.$row->lastName.'</td>
                      <td>'.$row->grade.'</td>
                    </tr>';

          }
          return response()->json($output);
      }
      else {
        $output = "<tr> <td colspan='4'> No results were found </td> </tr> ";
        return response()->json($output);
      }
     
    }
}
