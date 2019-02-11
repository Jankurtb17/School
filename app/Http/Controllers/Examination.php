<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\exam;
use App\schoolyear;
use DB;

class Examination extends Controller
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
        $examination = exam::paginate(10);
        $schlyr = schoolyear::all();
        return view('Dashboard.examination', compact('examination', 'schlyr', 'student', 'teacher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.examination');
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
          'schoolYear'  => 'required|string',
          'grading'     => 'required|string',
          'startDate'   => 'required|string',
          'endDate'     => 'required|string',
        ]);
        $exam = exam::create([
          'schoolYear'    =>$request->get('schoolYear'),
          'grading'       =>$request->get('grading'),
          'startDate'     =>$request->get('startDate'),
          'endDate'       =>$request->get('endDate'),
        ]);
        return redirect('/examination')->with('Success', 'Examination date successfully added!');
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
        $exam = exam::fimdOrFail($id);
        return view('/examination', compact('exam', 'id'));
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
        $exam = exam::findOrFail($id);
        $exam->schoolYear = $request->schoolYear;
        $exam->grading = $request->grading;
        $exam->startDate = $request->startDate;
        $exam->endDate = $request->endDate;
        $exam->save();
        return response()->json($exam);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam = exam::findOrFail($id);
        $exam->delete();
        return response()->json($exam);
    }
}
