<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Session;
use App\Exports\TeacherExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\firstgradings;

class AddTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    { 
        $teacher = DB::table('users')
              ->where('role_id', 3)
              ->count();
        $student = DB::table('users')
              ->where('role_id', 1)
              ->count();
       $user = DB::table('users')
                    ->where('role_id', 3)
                    ->get();
        $user_teacher = $this->get_teacher();
       return view('Dashboard.teacher', compact('user', 'teacher', 'student' ,'user_teacher'));
    }

    public function get_teacher()
    {
      $user_teacher = DB::table('users')
                      ->where('role_id', 3)
                      ->get();
      return $user_teacher;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.teacher');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'employee_Id'  => 'required|string',
            'firstName'    => 'required|string',
            'lastName'     => 'required|string',
            'email'        => 'required|string|unique:users',
            'password'     => 'required|string|alpha_num|min:6',
        ]);
        $user = User::create([
            'user_type'      => 'teacher',
            'role_id'        => '3',
            'employee_id'    => $request->get('employee_Id'),
            'firstName'      => $request->get('firstName'),
            'middleName'     => $request->get('middleName'),
            'lastName'       => $request->get('lastName'),
            'gender'         => $request->get('gender'),
            'email'          => $request->get('email'),
            'password'       => bcrypt($request->get('password')),
            'phone_number'   =>$request->get('phone_number'),
            'status'         => 'Active', 
            'remember_token' => str_random(20)
        ]);
        return redirect('/addteacher')->with('success', ' successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }

    public function search(Request $request)
    {
      if($request->ajax())
      {
        $output = "";
        $search = $request->get('search');
        if($search != ''){
          $data = DB::table('users')
                    ->where('firstName', 'LIKE', '%'.$search.'%')
                    ->Where('role_id',  3)
                    ->paginate(5);
        }
        else {
          $data = DB::table('users')
                    ->where('role_id', 3)
                    ->paginate(5);
        }
        $total_rows = $data->count();
        if($total_rows > 0)
        {
          foreach($data as $row)
          {
            $output .= '<tr>
                  <td>'.$row->employee_id.'</td>
                  <td>'.$row->firstName.'</td>
                  <td>'.$row->lastName.'</td>
                  <td>'.$row->email.'</td>
                  </tr>
            ';
          }
        }
        else {
          $output ="<tr> <td colspan='5'> No results were found</td> </tr>";
        }
        return response()->json($output);
      }
    }

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

       return view('Dashboard.viewteacher', compact('schoolyear','user', 'subjectCode','student', 'teacher', 'gradelevel'));
    }

    public function excel()
    {
      return Excel::download(new TeacherExport, 'Teacher.xlsx');
    }

    public function fetch(Request $request)
    {
      $gradeLevel = $request->get('gradeLevel');
      $subjectCode = $request->get('subjectCode');
      $data = DB::table('sendgradeadmins')
                ->where('student_id', $student_id)
                ->get();
                }

    public function pdf()
    {
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_teacher_data());
      return $pdf->stream();
    }

    public function convert_teacher_data()
    {
      $user_teacher = $this->get_teacher();
      $output = '
            <div>
                <h2>ANGELS OF DE VERA LEARNING CENTER </h2>
                <span> Blk 1 lot 33 phase 2 Molino Homes III</span> <br>
                <span> Molino, Cavite </span> <br>
                <span>Jankurt@anglesdevera.com </span>
                <br> <br>
                <span> List of Teacher</span>
            </div>
            <table class="table table-bordered" style="margin: 50px 20px 0px 0px; width: 750px; font-family:roboto">
                <tr>
                    <th> Employee Id </th>
                    <th> First Name </th>
                    <th> Middle Initial </th>
                    <th> Last Name </th>
                    <th> Contact Number </th>
                    <th> Email </th>
                </tr>
       ';
       foreach($user_teacher as $user)
        {
            $output .= '
                  <tr>
                    <td style="width:100px;">'.$user->employee_id.' </td>
                    <td>'.$user->firstName.' </td>
                    <td>'.$user->middleName.' </td>
                    <td>'.$user->lastName.' </td>
                    <td style="width:100px;">'.$user->phone_number.' </td>
                    <td>'.$user->email.' </td>
                  </tr>';
        }
            $output .= '</table>';
            return $output;
    }

    
    public function searchAdminGrade(Request $request)
    {
      $gradingperiod = $request->get('gradingperiod');
      $gradeLevel    = $request->get('gradeLevel');
      $subjectCode   = $request->get('subjectCode');
      $schoolyear    = $request->get('schoolYear');
      $employee_id   = $request->get('employee_id');
      $output = '';
      $data = DB::table('sendgradeadmins')
                ->join('users','sendgradeadmins.student_id', '=', 'users.student_id')
                ->where('users.gradeLevel', "LIKE", '%'.$gradeLevel.'%')
                ->where('sendgradeadmins.schoolYear', "LIKE", '%'.$schoolyear.'%')
                ->where('sendgradeadmins.gradingperiod',"LIKE", '%'.$gradingperiod.'%')
                ->where('sendgradeadmins.subjectCode', "LIKE",'%'.$subjectCode.'%')
                ->where('sendgradeadmins.employee_id',"LIKE", '%'.$employee_id.'%')
                ->groupBy('sendgradeadmins.student_id')
                ->orderBy('gender', 'DESC')
                ->get();
      $total_rows = $data->count();
      if($total_rows > 0)
      {
          foreach($data as $row)
          {
            $grade = $row->grade;
            if($grade >= 75)
            {
            $output .= '
                <tr>
                  <td>'.$row->student_id.'</td>
                  <td>'.$row->gender.'</td>
                  <td>'.$row->firstName.'</td>
                  <td>'.$row->lastName.'</td>
                  <td> <input type="hidden" value="'.$row->grade.'" id="grade" name="grade[]">'.$row->grade.'</td>
                  <td> <span class="badge badge-success"> Passed </span> </td>
                  <td> <input type="checkbox" id="student_id" value="'.$row->id.'" name="student_id[]"> </td
                  <input type="hidden" id="gradeLevel" name="gradeLevel" value="'.$row->gradeLevel.'">
                  <input type="hidden" id="schoolYear" name="schoolYear" value="'.$row->schoolYear.'">
                  <input type="hidden" id="gradingperiod" name="gradingperiod" value="'.$row->gradingperiod.'">
                  <input type="hidden" id="className" name="className" value="'.$row->className.'">
                  <input type="hidden" id="employee_id" name="employee_id" value="'.$row->employee_id.'">
                </tr>
                ';
            }
            else {
              $output .= '
                <tr>
                  <td>'.$row->student_id.'</td>
                  <td>'.$row->gender.'</td>
                  <td>'.$row->firstName.'</td>
                  <td>'.$row->lastName.'</td>
                  <td>'.$row->grade.'</td>
                  <td> <span class="badge badge-danger">Failed </span></td>
                  <td> <input type="checkbox" id="student_id" value="'.$row->id.'" name="student_id[]"> </td
                  <input type="hidden" id="gradeLevel" name="gradeLevel" value="'.$row->gradeLevel.'">
                  <input type="hidden" id="schoolYear" name="schoolYear" value="'.$row->schoolYear.'">
                  <input type="hidden" id="gradingperiod" name="gradingperiod" value="'.$row->gradingperiod.'">
                  <input type="hidden" id="className" name="className" value="'.$row->className.'">
                  <inp
                </tr>
                ';
            }
          }
          return response()->json($output);
      }
      else {
        $output = "<tr> <td colspan='4'> Grade not encoded </td> </tr> ";
        return response()->json($output);
      }
    }

    public function submitGradeAdmin(Request $request)
    {
        $student = $request->get('student_id');
        $grade = $request->get('grade');

        foreach($input as $students => $key)
        {
            $datas[] = array(
              'student_id' =>$input[$students],
              'grade'   =>$input[$students]
            );
        }
        $data = DB::table('firstgradings')->insert($datas);
        return response()->json($data);
    }

}
