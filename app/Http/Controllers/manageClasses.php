<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nameOfClasses;
use App\subject;
use App\manageclass;

class manageClasses extends Controller  
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $manageclass = manageclass::all();
        $nameOfClasses = nameOfClasses::all();
        $subject = subject::all();
        return view('Dashboard.studentclass', compact('nameOfClasses', 'subject', 'manageclass'));
    }

  /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.studentclass');
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
          'className'   => 'required|string',
          'studentName' => 'required|string',
          'subjectName' => 'required|string'
          
        ]);
        manageclass::create([
          'className'   =>$request->get('className'),
          'studentName' =>$request->get('studentName'),
          'subjectName' =>$request->get('subjectName')
        ]);
        return redirect('/studentclass')->with('success', 'CLass successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $manageclass = manageclass::findOrFail($id);
        return view('Dashboard.studentclass', compact('manageclass'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $manageclass = manageclass::findOrFail($id);
      return view('Dashboard.studentclass', compact('manageclass', 'id'));
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
      $manageclass = manageclass::findOrFail($id);
      $manageclass->className = $request->className;
      $manageclass->studentName = $request->studentName;
      $manageclass->subjectName = $request->subjectName;
      $manageclass->save();
      return response()->json($manageclass);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manageclass = manageclass::findOrFail($id);
        $manageclass->delete();
        return response()->json($manageclass);
    }
}
