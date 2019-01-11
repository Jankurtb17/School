<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\student;
use App\User;
use Illuminate\Support\Facades\Auth;

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
        $student = student::all();
        return view('Dashboard.student', compact('student'));
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
            'studentNumbers'         => 'required|string',
            'level'                 => 'required|string',
            'firstName'             => 'required|string',
            'lastName'              => 'required|string',
            'contactNumber'         => 'required|string',
            'email'                 => 'required|string',
            'password'              => 'required|string',
           
        ]);
            User::create([
            'user_type'           => 'student',
            'role_id'             => '1',
            'studentNumbers'      =>$request->get('studentNumbers'),
            'level'               =>$request->get('level'),
            'firstName'           =>$request->get('firstName'),
            'lastName'            =>$request->get('lastName'),
            'contactNumber'       =>$request->get('contactNumber'),
            'email'               =>$request->get('email'),
            'password'            =>bcrypt($request->get('password')),
        ]);
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
}
