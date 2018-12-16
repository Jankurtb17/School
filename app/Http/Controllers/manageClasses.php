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
          'class'   =>$request->get('className'),
          'student' =>$request->get('studentName'),
          'subject' =>$request->get('subjectName')
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
