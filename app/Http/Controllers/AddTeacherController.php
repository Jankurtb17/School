<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Session;

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
                    ->paginate(7);
       return view('Dashboard.teacher', compact('user', 'teacher', 'student'));
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
            'contactNumber'  => $request->get('contactNumber'),
            'email'          => $request->get('email'),
            'password'       => bcrypt($request->get('password')),
            'contactNumber'  =>$request->get('contactNumber'),
            'remember_token'      => str_random(20)

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
      $advisory = DB::table('advisories')
                ->join('search_subjects', 'advisories.subjectCode', '=', 'search_subjects.subjectCode')
                ->where('advisories.employee_id', $employee_id)
                ->get();
      $user= DB::table('users')
                ->where('employee_id', $employee_id)
                ->get();
       return view('Dashboard.viewteacher', compact('user','student', 'teacher', 'advisory'));
    }

}
