<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\subject;
use App\yearlevels;
use App\nameOfClasses;
use DB;

class subjectview extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $yearlevel = DB::table('yearlevels')
                      ->groupBy('gradeLevel')
                      ->get();
        $subject =  subject::all();
        return view('Dashboard.subject', compact('yearlevel', 'subject'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('Dashboard.subject');
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
          'gradeLevel'      => 'required|string',
          'className'       => 'required|string',
          'subjectCode'     => 'required|string',
          'description'     => 'required|string'
        ]);

        subject::create([
          'gradeLevel'        =>$request->get('gradeLevel'),
          'className'         =>$request->get('className'),
          'subjectCode'       =>$request->get('subjectCode'),
          'description'       =>$request->get('description')
        ]);

        return redirect('/subject')->with('success', 'subject successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = subject::findOrFail($id);
        return view('Dashboard.subject', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suject = subject::findOrFail($id);
        return view('Dashboard.subject', compact('subject', 'id'));
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
        $subject = subject::findOrFail($id);
        $subject->subjectName = $request->subjectName;
        $subject->description = $request->description;
        $subject->yearLevel = $request->yearLevel;
        $subject->save();
        return response()->json($subject);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = subject::findOrFail($id);
        $subject->delete();
        return response()->json($subject);
    }

    public function fetch(Request $request)
    {
      $select    = $request->get('select');
      $value     = $request->get('value');
      $dependent = $request->get('dependent');
      $data = DB::table('yearlevels')
                ->where($select, $value)
                ->groupBy($dependent)
                ->get();
      $output  = '<option value=""  selected disabled>-Select Class-</option>';
      foreach($data as $row)
      {
        $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
      }
      echo $output;
    }
    
}
