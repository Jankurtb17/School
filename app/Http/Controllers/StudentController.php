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
        $user_student = DB::table('users')
                      ->where('role_id', 1)
                      ->orderBy('gradeLevel', 'asc')
                      ->get();
        $yearlevel = yearlevels::all();
        $schoolyear = schoolyear::all();
        return view('Dashboard.student', compact('schoolyear','students','user_student', 'yearlevel', 'student', 'admin', 'teacher', 'student_data'));
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
      $studone = $request->get('studone');
      $studtwo = $request->get('studtwo');
      $studthree = $request->get('studthree');
      $student_id = "".$studone."-".$studtwo."-".$studthree;
      $phone_one = $request->get('phone_one');
      $phone_two = $request->get('phone_number');
      $phone_number = "".$phone_one."".$phone_two;
        $this->validate($request, [
            'gradeLevel'            => 'required|string',
            'className'             => 'required|string',
            'firstName'             => 'required|string',
            'lastName'              => 'required|string',
            'gender'                => 'required|string',
            'dateOfBirth'           => 'required|string',
            'phone_number'          => 'required|string',
            'address'               => 'required|string',
            'email'                 => 'required|string|unique:users',
            'password'              => 'required|string|confirmed|alpha_num|min:6',
        ]);
            User::create([
            'user_type'           => 'student',
            'role_id'             => '1',
            'student_id'          =>$student_id,
            'gradeLevel'          =>$request->get('gradeLevel'),
            'className'           =>$request->get('className'),
            'firstName'           =>$request->get('firstName'),
            'middleName'          =>$request->get('middleName'),
            'lastName'            =>$request->get('lastName'),
            'gender'              =>$request->get('gender'),
            'dateOfBirth'         =>$request->get('dateOfBirth'),
            'address'             =>$request->get('address'),
            'email'               =>$request->get('email'),
            'password'            =>bcrypt($request->get('password')),
            'phone_number'        =>$phone_number,
            'status'              =>'Active',
            'parentFirstName'     =>$request->get('parentFirstName'),
            'parentLastName'     =>$request->get('parentLastName'),
            'parentMiddleName'     =>$request->get('parentMiddleName'),
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
     *git 
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

    public function updateinfo(Request $request, $id)
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
    

    //dynamic selectbox
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
      return response()->json($output);
    }



    //viewstudent
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
                  ->where('search_subjects.gradelevel', $gradelevel)
                  ->where('sendgradeadmins.student_id', $student_id)
                  ->where('sendgradeadmins.gradingperiod', 1)
                  ->whereNull('deleted_at')
                  ->get(); 
    $second = DB::table('search_subjects')
                  ->join('sendgradeadmins', 'search_subjects.subjectCode', '=', 'sendgradeadmins.subjectCode')
                  ->where('search_subjects.gradelevel', $gradelevel)
                  ->where('sendgradeadmins.student_id', $student_id)
                  ->where('sendgradeadmins.gradingperiod', 2)
                  ->whereNull('deleted_at')
                  ->get(); 
    $third = DB::table('search_subjects')
                  ->join('sendgradeadmins', 'search_subjects.subjectCode', '=', 'sendgradeadmins.subjectCode')
                  ->where('search_subjects.gradelevel', $gradelevel)
                  ->where('sendgradeadmins.student_id', $student_id)
                  ->where('sendgradeadmins.gradingperiod', 3)
                  ->whereNull('deleted_at')
                  ->get(); 
    $fourth = DB::table('search_subjects')
                  ->join('sendgradeadmins', 'search_subjects.subjectCode', '=', 'sendgradeadmins.subjectCode')
                  ->where('search_subjects.gradelevel', $gradelevel)
                  ->where('sendgradeadmins.student_id', $student_id)
                  ->where('sendgradeadmins.gradingperiod', 4)
                  ->whereNull('deleted_at')
                  ->get(); 
    $final = DB::table('search_subjects')
                  ->join('sendgradeadmins', 'search_subjects.subjectCode', '=', 'sendgradeadmins.subjectCode')
                  ->where('search_subjects.gradelevel', $gradelevel)
                  ->where('sendgradeadmins.student_id', $student_id)
                  ->where('sendgradeadmins.gradingperiod', 'final')
                  ->whereNull('deleted_at')
                  ->get(); 
    $subject = DB::table("search_subjects")
                ->where('gradeLevel', $gradelevel)
                ->get();
    $schoolyear = DB::table('schoolyears')->get();
      return view('Dashboard.viewstudent', compact('schoolyear','user', 'teacher', 'student', 'first', 'second', 'subject', 'third', 'fourth', 'final'));
    }

    public function excel()
    {
      return Excel::download(new UsersExport, 'Students.csv');
    }

    public function pdf()
    { 
      $user_student = DB::table('users')
              ->where('role_id', 1)
              ->orderBy('gradeLevel', 'asc')
              ->get();
        $pdf = \App::make('dompdf.wrapper');
        $pdf = PDF::loadview('Dashboard.pdfstudent', compact('user_student'));
        return $pdf->stream();
    }

    public function pdfgrades($student_id)
    { 
      $grades = DB::table('search_subjects')
                  ->join('sendgradeadmins', 'search_subjects.subjectCode', '=', 'sendgradeadmins.subjectCode')
                  ->join('users', 'sendgradeadmins.employee_id', '=', 'users.employee_id')
                  ->where('sendgradeadmins.student_id', $student_id)
                  ->whereNull('deleted_at')
                  ->orderBy('gradingperiod')
                  ->get(); 
        $pdf = \App::make('dompdf.wrapper');
        $pdf = PDF::loadview('Dashboard.pdfgradestudent', compact('grades'));
        return $pdf->stream();
    }
    
   
    public function sendGrade(Request $request)
    {
      $grade = $request->get('grade');
      $phone_number = $request->get('phone_number');
      $description = $request->get('description');
      $data = "";
      foreach ($grade as $row => $key) {
        $data .= $description[$row].": " .$grade[$row]."\n";
      }
     
      $nexmo = app('Nexmo\Client');

      $nexmo->message()->send([
          'to'   => $phone_number,
          'from' => '639565011210', 
          'text' =>  $data
      ]);
      
      return redirect('/student')->with('success', 'successfully send!');
    }
}
