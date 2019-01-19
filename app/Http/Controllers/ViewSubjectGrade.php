<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\schoolyear;

class ViewSubjectGrade extends Controller
{
    public function index()
    { 
      $schoolyear = schoolyear::all();
      $advisory = DB::table('advisories')
                    ->where('employee_id', Auth()->user()->employee_id)
                    ->groupBy('gradeLevel')
                    ->get();
      return view('teacher.subjectgrade', compact('advisory', 'schoolyear'));
    }

    public function studentSearch(Request $request)
    {
      $output = '';
      $gradeLevel = $request->get('gradeLevel');
      $className = $request->get('className');
      $search = DB::table('users')
                    ->where('gradeLevel' , $gradeLevel)
                    ->orWhere('className', $className)
                    ->get();
      $count = count($search);

      if($count > 0)
      {
        foreach($search as $row)
          {
            $output .= '
              <tr>
                <td>'.$row->student_id.'</td>
                <td>'.$row->firstName.'</td>
                <td>'.$row->lastName.'</td>
                <td>'.$row->middleName.'</td>
                </tr>
            ';
          }
          return response()->json($output);
      }
      else {
        $output = '<tr> <td colspan="5"> No result were found </td>';
      }
    }

    public function fetch(Request $request)
    {
      $output = '';
      $select = $request->get('select');
      $value = $request->get('value');
      $dependent = $request->get('dependent');
      $data = DB::table('yearlevels')
                ->where($select, $value)
                ->groupBy($dependent)
                ->get();
      $output = '<option value="">Select Class </option>';
      foreach($data as $row)
      {
        $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
      }
      echo $output;
    }
}

