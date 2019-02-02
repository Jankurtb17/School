<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\yearlevels;
use App\schoolyear;
use Illuminate\Support\Facades\DB;

class yearlevel extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    { 
      $admin = DB::table('users')
              ->where('role_id', 2)
              ->count();
        $teacher = DB::table('users')
              ->where('role_id', 3)
              ->count();
        $student = DB::table('users')
              ->where('role_id', 1)
              ->count();
        $schoolyear = schoolyear::all();
        $yearlevel = yearlevels::sortable()->paginate(10);
        return view('Dashboard.gradelevel', compact('yearlevel', 'schoolyear', 'student', 'admin', 'teacher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.gradelevel');
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
          'schoolYear'   => 'required|string',
          'gradeLevel' => 'required|string',
          'className'  => 'required|string'
        ]);
        $schoolyear = $request->get('schoolYear');
        $gradeLevel = $request->get('gradeLevel');
        $className  = $request->get('className');
        $data = DB::table('yearlevels')
                  ->where('gradeLevel', $gradeLevel)
                  ->count();
        if($data > 0){
          return redirect('/gradelevel')->with('error', 'already taken! ');
        }
        else{
          yearlevels::create([
            'schoolYear'     =>$schoolyear,
            'gradeLevel'     =>$gradeLevel,
            'className'      =>$className
          ]);
        }
        return redirect('/gradelevel')->with('success', 'successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $yearlevel = yearlevels::findOrFail($id);
        return view('Dashboard.gradelevel', compact('yearlevel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $yearlevel = yearlevels::findOrFail($id);
        return view('Dashboard.gradelevel', compact('yearlevel', 'id'));
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
        $yearlevel = yearlevels::findOrFail($id);
        $yearlevel->schoolYear = $request->schoolYear;
        $yearlevel->gradeLevel = $request->gradeLevel;
        $yearlevel->className = $request->className;
        $yearlevel->save();
        return response()->json($yearlevel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $yearlevel = yearlevels::findOrFail($id);
        $yearlevel->delete();
        return response()->json($yearlevel);
    }
   
}
