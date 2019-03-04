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
use App\sendgradeadmin;

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
        $phone_one = $request->get('phone_one');
        $phone_two = $request->get('phone_numbertwo');
        $phone_number = "".$phone_one."".$phone_two;
        $phone_numberone = $request->get('phone_numberone');
        $phone_numbertwo = $request->get('phone_number');
        $phone_numberreal = "".$phone_numberone."".$phone_numbertwo;
        $this->validate($request, [
            'employee_Id'  => 'required|string',
            'firstName'    => 'required|string',
            'lastName'     => 'required|string',
            'address'      => 'required|string',
            'email'        => 'required|string|unique:users',
            'password'     => 'required|string|confirmed|alpha_num|min:6',
            'phone_number' => 'required|string',
        ]);
        $user = User::create([
            'user_type'      => 'teacher',
            'role_id'        => '3',
            'employee_id'    => $request->get('employee_Id'),
            'firstName'      => $request->get('firstName'),
            'middleName'     => $request->get('middleName'),
            'lastName'       => $request->get('lastName'),
            'gender'         => $request->get('gender'),
            'dateOfBirth'    => $request->get('dateOfBirth'),
            'address'        => $request->get('address'),
            'email'          => $request->get('email'),
            'password'       => bcrypt($request->get('password')),
            'phone_number'   =>$phone_numberreal,
            'status'         => 'Active', 
            'phone_number2'  =>$phone_number,
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
    public function edit($id)
    {
        $teacher = User::findOrFail($id);
        return view('Dashboard.teacher', compact('teacher', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $teacher = User::findOrFail($id);
      $teacher->status = $request->status;
      $teacher->save();
      return response()->json($teacher);
      // return redirect('/teacher')->with('success', 'Successfully Updated!');
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
                
    // generate PDF for teachers
    public function pdf()
    {
      $user_teacher = DB::table('users')
                      ->where('role_id', 3)
                      ->get();
      $pdf = \App::make('dompdf.wrapper');
      $pdf = PDF::loadview('Dashboard.pdfteacher', compact('user_teacher'));
      return $pdf->stream();
    }

    // generate PDF for teachers
    public function gradepdf($employee_id)
    {
      $grade = DB::table('sendgradeadmins')
                   ->join('users', 'sendgradeadmins.student_id', '=', 'users.student_id')
                   ->where('sendgradeadmins.employee_id', $employee_id)
                   ->orderBy('sendgradeadmins.gradingperiod', 'ASC')
                   ->get();
      $pdf = \App::make('dompdf.wrapper');
      $pdf = PDF::loadview('Dashboard.pdfgrades', compact('grade'));
      return $pdf->stream();
    }

    public function get_teacher()
    {
      $user_teacher = DB::table('users')
                      ->where('role_id', 3)
                      ->get();
      return $user_teacher;
    }

    
    public function searchAdminGrade(Request $request)
    {
      $gradeLevel    = $request->get('gradeLevel');
      $subjectCode   = $request->get('subjectCode');
      $schoolyear    = $request->get('schoolYear');
      $employee_id   = $request->get('employee_id');
      $gradingperiod = $request->get('gradingperiod');
      $output = '';
      $data = DB::table('sendgradeadmins')
                ->join('search_subjects', 'sendgradeadmins.subjectCode', '=', 'search_subjects.subjectCode')
                ->join('users','sendgradeadmins.student_id', '=', 'users.student_id')
                ->select('users.gender', 'users.student_id', 'users.firstName', 'users.middleName', 'users.lastName', 'sendgradeadmins.*', 'search_subjects.description')
                ->where('sendgradeadmins.gradeLevel', 'LIKE', '%'.$gradeLevel.'%')
                ->where('sendgradeadmins.schoolYear', 'LIKE', '%'.$schoolyear.'%')
                ->where('sendgradeadmins.subjectCode', 'LIKE','%'.$subjectCode.'%')
                ->where('sendgradeadmins.gradingperiod','LIKE', '%'.$gradingperiod.'%')
                ->where('sendgradeadmins.employee_id','LIKE', '%'.$employee_id.'%')
                ->groupBy('sendgradeadmins.grade')
                ->orderBy('sendgradeadmins.gradingperiod', 'ASC')
                ->get();
      $total_rows = $data->count();
      if($total_rows > 0)
      {
          foreach($data as $row)
          {
            $output .= '
                <tr>
                  <td> <input type="hidden" value="'.$row->id.'" name="id[]" id="id">'.$row->id.'</td>
                  <td>'.$row->gender.'</td>
                  <td>'.$row->className.'</td>
                  <td>'.$row->student_id.'</td>
                  <td>'.$row->firstName.' '.$row->lastName.'</td>  
                  <td> <input type="hidden" class="form-control" value="'.$row->grade.'" id="grade" name="grade[]"><input type="text"  size="1" value="'.$row->grade.'" style="text-align:center;"></td>
                  <td> <span class="badge badge-success"> Passed </span> </td>
                  <td> <button type="submit" class="btn btn-dark btn-sm">Update Grade</td>`
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




}
