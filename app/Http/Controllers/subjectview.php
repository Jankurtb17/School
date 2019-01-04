<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\subject;
use App\yearlevels;

class subjectview extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subject = subject::all();
        return view('Dashboard.subject', compact('subject'));
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
          'subjectName'   => 'required|string',
          'description'   => 'required|string',
          'yearLevel'     => 'required|string'
        ]);

        subject::create([
          'subjectName'     =>$request->get('subjectName'),
          'description'     =>$request->get('description'),
          'yearLevel'       =>$request->get('yearLevel')
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

    
}
