<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use DB;
use App\yearlevels;
use PDF;
use App\schoolyear;
use App\sendgradeadmin;

class StudentController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $admin = DB::table('users')
              ->where('role_id', 2)
              ->count();
        $teacher = DB::table('users')
              ->where('role_id', 3)
              ->count();
        $student = DB::table('users')
              ->where('role_id', 1)
              ->count();
        $students = DB::table('users')
                      ->where('role_id', 1)
                      ->orderBy('gradeLevel', 'asc')
                      ->get();
        $yearlevel = yearlevels::all();
        $schoolyear = schoolyear::all();
        $user_student = $this->get_student_data();
        return view('Dashboard.student', compact('schoolyear','students','user_student', 'yearlevel', 'student', 'admin', 'teacher', 'student_data'));
    }

    public function get_student_data()
    {
      $user_student = DB::table('users')
                      ->where('role_id', 1)
                      ->orderBy('gradeLevel', 'asc')
                      ->get();
      return $user_student;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.student');
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
            'student_id'            => 'required|string|unique:users',
            'gradeLevel'            => 'required|string',
            'className'             => 'required|string',
            'firstName'             => 'required|string',
            'lastName'              => 'required|string',
            'gender'                => 'required|string',
            'email'                 => 'required|string|unique:users',
            'password'              => 'required|string',
            'phone_number'         => 'required|string',
        ]);
            User::create([
            'user_type'           => 'student',
            'role_id'             => '1',
            'student_id'          =>$request->get('student_id'),
            'gradeLevel'          =>$request->get('gradeLevel'),
            'className'           =>$request->get('className'),
            'firstName'           =>$request->get('firstName'),
            'middleName'          =>$request->get('middleName'),
            'lastName'            =>$request->get('lastName'),
            'gender'              =>$request->get('gender'),
            'email'               =>$request->get('email'),
            'password'            =>bcrypt($request->get('password')),
            'phone_number'        =>$request->get('phone_number'),
            'status'              =>'Active',
            'parentFirstName'     =>$request->get('parentFirstName'),
            'parentLastName'     =>$request->get('parentLastName'),
            'parentMiddleName'     =>$request->get('parentMiddleName'),
            'phone_number2'     =>$request->get('phone_number2'),
            'remember_token'      => str_random(20)
        ]);
        session()->flash('notif', ' successfully added');
        return redirect('/student')->with('success', 'student successfully added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = User::findOrFail($id);
        return view('Dashboard.student', compact('student', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $student = User::findOrFail($id);
      $student->schoolYear = $request->get('schoolYear');        
      $student->gradeLevel = $request->get('gradeLevel');        
      $student->className = $request->get('className');        
      $student->status = $request->get('status');        
      $student->save();
      return response()->json($student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function fetch(Request $request)
    {
      $select = $request->get('select');
      $value = $request->get('value');
      $dependent = $request->get('dependent');
      $data = DB::table('yearlevels')
                ->where($select, $value)
                ->groupBy($dependent)
                ->get();
      $output = '<option value="" selected disabled>-Select Class-</option>';
      foreach($data as $row)
      {
        $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
      }
      echo $output;
    }

    public function search(Request $request)
    {
      if($request->ajax())
      {
        $output = "";
        $search = $request->get('search');
        if($search != '')
        {
          $data = DB::table('users')
                    ->where('firstName', 'LIKE', '%'.$search.'%')
                    ->where('role_id', 1)
                    ->groupBy('gradeLevel')
                    ->paginate(5);
        }
        else {
          $data = DB::table('users')
                  ->where('role_id', 1)
                  ->groupBy('gradeLevel')
                  ->paginate(5);
        }

        $total_rows = $data->count();
        if($total_rows > 0)
        {
          foreach($data as $row)
          {
            $output .= '<tr>
                <td><a href="/student/'.$row->student_id.'">'.$row->student_id.'</a></td>
                <td>'.$row->gradeLevel.'</td>
                <td>'.$row->firstName.'</td>
                <td>'.$row->lastName.'</td>
                <td>'.$row->email.'</td>
                <td> <button class="btn btn-warning"><i class="fa fa-pencil-square-o"> </i>Edit</button></td>
                </tr>';
          }
        }
        else {
          $output = "<tr><td coslpan='6'>No results were found </td> </tr>";
        }
        return response()->json($output);
      }
    }

    public function select($student_id, $gradelevel)
    {
     
    $teacher = DB::table('users')
                ->where('role_id', 3)
                ->count();
    $student = DB::table('users')
                ->where('role_id', 1)
                ->count();
  
    $user = DB::table('users')
                ->where('student_id', $student_id)
                ->groupBy('student_id')
                ->get();
    $first = DB::table('search_subjects')
                ->join('sendgradeadmins', 'search_subjects.subjectCode', '=', 'sendgradeadmins.subjectCode')
                ->select('search_subjects.subjectCode', 'search_subjects.description', 'sendgradeadmins.grade' )
                ->where('sendgradeadmins.student_id', '=', $student_id)
                ->where('sendgradeadmins.gradingperiod', '=',2)
                ->where('search_subjects.gradeLevel', $gradelevel) 
                ->groupBy('search_subjects.subjectCode')
                  ->get(); 
              
   
    // $first = DB::table('firstgradings')
    //               ->select('grade' DB::raw('COUNT(grade) as COUNT'))
    //               ->groupBy('student_id')
    //               ->get();
                  
    $second = DB::table('firstgradings')
                ->where('student_id', $student_id)
                ->where('gradingperiod', 2)
                ->groupBy('subjectCode')
                ->orderBy('subjectCode', 'DESC')
                ->get();
    $subject = DB::table("search_subjects")
                ->where('gradeLevel', $gradelevel)
                ->get();
    $schoolyear = DB::table('schoolyears')->get();
      return view('Dashboard.viewstudent', compact('schoolyear','user', 'teacher', 'student', 'first', 'second', 'subject'));
    }

    public function excel()
    {
      return Excel::download(new UsersExport, 'Students.csv');
    }

    public function pdf()
    {
       $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_user_data());
        return $pdf->download();
    }
    
    public function convert_user_data() 
    {
      $user_student = $this->get_student_data();
      $output = '
            <div>
                <h2>ANGELS OF DE VERA LEARNING CENTER </h2>
                <span> Blk 1 lot 33 phase 2 Molino Homes III</span> <br>
                <span> Molino, Cavite </span> <br>
                <span>Jankurt@anglesdevera.com </span>
                <br> <br>
                <span> List of students</span>
            </div>
            <table class="table table-bordered" style="margin: 50px 20px 0px 0px; width: 750px; font-family:roboto">
                <tr>
                    <th> Student Id </th>
                    <th> Grade Level </th>
                    <th> Class Name </th>
                    <th> First Name </th>
                    <th> Middle Initial </th>
                    <th> Last Name </th>
                    <th> Contact Number </th>
                    <th> Email </th>
                </tr>
       ';
       foreach($user_student as $user)
        {
            $output .= '
                  <tr>
                    <td style="width:100px;">'.$user->student_id.' </td>
                    <td >'.$user->gradeLevel.' </td>
                    <td>'.$user->className.' </td>
                    <td>'.$user->firstName.' </td>
                    <td>'.$user->middleName.' </td>
                    <td>'.$user->lastName.' </td>
                    <td>'.$user->phone_number.' </td>
                    <td>'.$user->email.' </td>
                  </tr>';
        }
            $output .= '</table>';
            return $output;
    }
   
    public function updateStudent()
    {
      
    }
    public function sendGrade(Request $request)
    {
      $grade = $request->get('grade');
      $phone_number = $request->get('phone_number');
      $subjectCode = $request->get('subjectCode');

      foreach($grade as $row => $key)
      {
        $data[] = array(
            'grade'         => $grade[$row],
            'subjectCode'   => $subjectCode[$row]
        );
      }
      $nexmo = app('Nexmo\Client');

      $nexmo->message()->send([
          'to'   => '09565011210',
          'from' => '639565011210',
          'text' => ''
      ]);
    }
}
