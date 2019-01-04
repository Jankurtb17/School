<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\schoolyear;

class schoolyr extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $schoolyear = schoolyear::paginate(10);
        return view('Dashboard.schoolyear', compact('schoolyear'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.schoolyear');
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
            'schoolYear' => 'required|string'
        ]);
        
        schoolyear::create([
          'schoolYear'  => $request->get('schoolYear')
        ]);
        return redirect('/schoolyear')->with('sucess', 'SchoolYear Successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schoolyear = schoolyear::findOrFail($id);
        return view('Dashboard.schoolyear', compact('schoolyear'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schoolyear = schoolyear::findOrFail($id);
        return view('Dashboard.schoolyear', compact('schoolyear', 'id'));
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
        $schoolyear = schoolyear::findOrFail($id);
        $schoolyear->schoolYear = $request->schoolYear;
        $schoolyear->save();
        return response()->json($schoolyear);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schoolyear = schoolyear::findOrFail($id);
        $schoolyear->delete();
        return response()->json($schoolyear);
    }

}
