<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\sendgradeadmin;

class archieve extends Controller
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
      $grades = DB::table('sendgradeadmins')
            ->join('search_subjects', 'sendgradeadmins.subjectCode', '=', 'search_subjects.subjectCode')
            ->join('users', 'users.student_id', '=', 'sendgradeadmins.student_id')
            ->select('search_subjects.subjectCode', 'search_subjects.description', 'users.student_id', 'users.firstName', 'users.lastName', 'users.middleName','sendgradeadmins.*')
            ->get();
      return view('Dashboard.archieve', compact('grades', 'student', 'teacher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      sendgradeadmin::withTrashed()->findOrFail($id)->restore();
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
      $student = sendgradeadmin::whereIn('id',explode(",", $id))->findOrFail($id)->restore();;
      return response()->json($student);
    }

  
}
