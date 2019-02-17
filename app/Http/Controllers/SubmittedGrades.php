<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Nexmo\Client;
use Maatwebsite\Excel\Facades\Excel;
use PDF;


class SubmittedGrades extends Controller
{
    public function index()
    {
      $advisory = DB::table('advisories')
                    ->where('employee_id', Auth()->user()->employee_id)
                    ->groupBy('gradeLevel')
                    ->get();
      $schoolyear = DB::table('schoolyears')
                    ->get();
        return view('teacher.submitted', compact('advisory', 'schoolyear'));
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
                ->orderBy('subjectCode', 'DESC')
                ->get();
     $output = '<option value="" selected disabled>-Select Subject Code-</option>';
     foreach($data as $row)
     {
       $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
     }
     echo $output;
    }

    //search advisory usnig button
    public function search(Request $request)
    {
      $output = '';
      $gradingperiod = $request->get('gradingperiod');
      $gradeLevel    = $request->get('gradeLevel');
      $subjectCode   = $request->get('subjectCode');
      $schoolyear    = $request->get('schoolYear');
      $employee_id    = $request->get('employee_id');
      $data = DB::table('sendgradeadmins')
                ->leftjoin('users','sendgradeadmins.student_id', '=', 'users.student_id')
                ->select('users.student_id', 'users.gender', 'users.firstName', 'users.middleName', 'users.lastName','sendgradeadmins.*')
                ->where('sendgradeadmins.gradeLevel', 'LIKE', '%'.$gradeLevel.'%')
                ->where('sendgradeadmins.gradingperiod', 'LIKE',  '%'.$gradingperiod.'%')
                ->where('sendgradeadmins.subjectCode', 'LIKE',  '%'.$subjectCode.'%')
                ->where('sendgradeadmins.schoolYear', 'LIKE', '%'.$schoolyear.'%')
                ->where('sendgradeadmins.employee_id', 'LIKE', '%'.$employee_id.'%')
                ->get();

      $total_rows = $data->count();
      if($total_rows > 0)
      {
          foreach($data as $row)
          {
            $grade = $row->grade;
           
            $output .= '
                <tr>
                  <td> <input type="hidden" value="'.$row->student_id.'" id="student_od">'.$row->student_id.'</td>
                  <td>'.$row->gender.'</td>
                  <td>'.$row->firstName.'</td>
                  <td>'.$row->lastName.'</td>
                  <td> <input type="hidden" value="grade['.$row->grade.']">'.$row->grade.'</td>
                  <td> <span class="badge badge-success"> Passed </span> </td>
                </tr>
                ';
            }
         
          return response()->json($output);
      }
      else {
        $output = "<tr> <td colspan='4'> Grade not encoded </td> </tr> ";
        return response()->json($output);
      }
    }

    //create pdf//
    public function pdf()
    {
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->search($output));
      return $pdf->stream();
    }

    //send sms
    public function create()
    {
      return view('Teacher.submitted');
    }

    public function sendGrade(Request $request)
    {
      $student_id = $request->get('student_id');
      $grade = $request->get('student_id');
      $phone_number = $request->get('student_id');

      foreach($phone_number as $contact => $key)
      {
        $data[] = array(
          'student_id '   =>$student_id[$contact],
          'grade'         =>$grade[$contact],
          'phone_number'  =>$phone_number[$contact],
        );
      }
      SendGrade::create($data);
      return redirect('/viewgrades')->with('success', 'Successfully Send!');
    }
   
}
