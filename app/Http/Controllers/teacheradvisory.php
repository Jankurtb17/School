<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\subject;
use App\nameOfClasses;
use App\advisory;

class teacheradvisory extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subject = subject::all();
        $classname = nameOfClasses::all();
        $advisory = advisory::all();
        return view('Dashboard.teacheradvisory', compact('subject', 'classname', 'advisory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.teacheradvisory');
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
            'teacherName' =>  'required|string',
            'className'   =>  'required|string',
            'subjectName' =>  'required|string'
        ]);
        
        advisory::create([
            'teacherName' =>$request->get('teacherName'),
            'className'   =>$request->get('className'),
            'subjectName' =>$request->get('subjectName')
        ]);

        return redirect('/advisory')->with('success', 'Teacher advisory successfully added!');

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
