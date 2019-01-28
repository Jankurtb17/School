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
       $user = DB::table('users')
                    ->where('role_id', 3)
                    ->paginate(10);
       return view('Dashboard.teacher', compact('user'));
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
            'email'        => 'required|string',
            'password'     => 'required|string',
        ]);
        $user = User::create([
            'user_type'      => 'teacher',
            'role_id'        => '3',
            'employee_id'    => $request->get('employee_Id'),
            'firstName'      => $request->get('firstName'),
            'middleName'     => $request->get('middleName'),
            'lastName'       => $request->get('lastName'),
            'email'          => $request->get('email'),
            'password'       => bcrypt($request->get('password')),
            'remember_token' => str_random(20)
        ]);
        return redirect('/addteacher')->with('success', 'Teacher successfully added!');
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
}
