<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use DB;
use App\yearlevels;

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
        $students = DB::table('Users')
                      ->where('role_id', 1)
                      ->get();
        $yearlevel = yearlevels::all();
        return view('Dashboard.student', compact('students', 'yearlevel', 'student', 'admin', 'teacher'));
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
        //
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
        //
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
                    ->paginate(5);
        }
        else {
          $data = DB::table('users')
                  ->where('role_id', 1)
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
    $first = DB::table('firstgradings')
                ->where('student_id', $student_id)
                ->where('gradingperiod', 1)
                ->groupBy('subjectCode')
                ->get();
    $second = DB::table('firstgradings')
                ->where('student_id', $student_id)
                ->where('gradingperiod', 2)
                ->groupBy('subjectCode')
                ->get();
   

    // $subject = DB::table('search_subjects')
    //             ->where('gradeLevel', $gradelevel)
    //             ->get();
    // $finalgrade = DB::table('firstgradings')
    //             ->where('student_id', $student_id)
    //             ->get();

      return view('Dashboard.viewstudent', compact('user', 'teacher', 'student', 'first', 'second'));
    }
}
