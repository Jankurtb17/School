<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nameOfClasses;
use App\schoolyear;
use App\yearlevels;
use DB;
class nameOfClass extends Controller
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
        $schoolyear = schoolyear::all();
        $yearlevels =DB::table('yearlevels')
                        ->groupBy('gradeLevel')
                        ->get();
        $class = DB::table('name_of_classes')
                    ->get();
        return view('Dashboard.class', compact('class', 'schoolyear', 'yearlevels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.class');
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
          'yearLevel'   => 'required|string',
          'className'   => 'required|string',
        ]);

        nameOfClasses::create([
          'className'   =>$request->get('className'),
          'schoolYear'  =>$request->get('schoolYear'),
          'yearLevel'   =>$request->get('yearLevel')
        ]);
        return redirect('/class')->with('success', 'Class has been successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $class = nameOfClassess::findOrFail($id);
      return view('Dashboard.class', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $class = nameOfClasses::findOrFail($id);
      return view('Dashboard.class', compact('class', 'id'));
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
      $class = nameOfClasses::findOrFail($id);
      $class->className = $request->className;
      $class->schoolYear = $request->schoolYear;
      $class->yearLevel = $request->yearLevel;
      $class->save();
      return response()->json($class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = nameOfClasses::findOrFail($id);
        $class->delete();
        return response()->json($class);
    }

    // public function fetch(Request $request)
    // {
    //   $select = $request->get('select');
    //   $value = $request->get('value');
    //   $dependent = $request->get('dependent');
    //   $data = DB::table('name_of_classes')
    //               ->where($select, $value)
    //               ->groupBy($dependent)
    //               ->get();
    //   $output = '<select value="">-Select' .ucfirst($dependent).'</option>'; 
    //   foreach($data as $row)
    //   {
    //     $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
    //   }
    //   echo $output;

    // }
}
