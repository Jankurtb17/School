<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\schoolyear;
use App\firstgrading;
class ViewSubjectGrade extends Controller
{
    public function index()
    { 
      $schoolyear = schoolyear::all();
      $advisory = DB::table('advisories')
                    ->where('employee_id', Auth()->user()->employee_id)
                    ->get();
      return view('teacher.subjectgrade', compact('advisory', 'schoolyear'));
    }

    public function create()
    {
      return view('teacher.subjectgrade');
    }

    public function studentSearch(Request $request)
    {
      $output = '';
      $gradeLevel = $request->get('gradeLevel');
      $className = $request->get('className');
      $search = DB::table('users')
                    ->where('gradeLevel' , $gradeLevel)
                    ->orWhere('className', $className)
                    ->paginate(6);

      $count = count($search);
      if($count > 0)
      {
        foreach($search as $row)
          { 
            $output .= '

              <tr>
                <td> <a href="/studentgrades/'.$row->student_id.'"><input type="hidden" name="student_id" value="'.$row->student_id.'" id="a">'.$row->student_id.'</a></td>
                <td>'.$row->firstName.' '.$row->middleName.' '.$row->lastName.'</td>
                <td> <input type="text" class="form-control col-lg-2" id ="b" name="grade"> </td>
                </tr>
            ';
          }
    
          return response()->json($output);
      }
      else {
        $output = '<tr> <td colspan="5"> No result were found </td>';
        return response()->json($output);
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
                ->paginate(8);
      $output = '<option value="">Select Class </option>';
      foreach($data as $row)
      {
        $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
      }
      echo $output;
    }

    public function store(Request $request)
    {
      $student_id = $request->get('student_id');
      $grade = $request->get('grade');
       
      foreach($grade as $key)
      {
         $user_data = array(
           'student_id'  =>$student_id,
           'grade'       =>$grade
         );
      }

     $firstgrading = firstgrading::create($user_data);
      return response()->json($firstgrading);

    }

}

