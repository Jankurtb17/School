<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\advisory;
use Auth;
use App\User;
use DB;
use App\yearlevels;

class teacheradvisory extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = DB::Table('Users')
                ->where('role_id', 3)
                ->get();
      $advisory = advisory::all();
      $yearlevel = DB::table('yearlevels')
                      ->groupBy('gradeLevel')
                      ->get();
      return view('Dashboard.teacheradvisory', compact('user', 'advisory', 'yearlevel'));
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
          'gradeLevel'   =>  'required|string',
          'className'   =>  'required|string',
          'employee_id' =>  'required|string',
        ]);
        
        advisory::create([
            'user_id'     =>Auth::id(),
            'gradeLevel'   =>$request->get('gradeLevel'),
            'className'   =>$request->get('className'),
            'employee_id' =>$request->get('employee_id'),
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
        $advisory = advisory::findOrFail($id);
        return view('Dashboard.teacheradvisory', compact('advisory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $advisory = advisory::findOrFail($id);
      return view('Dashboard.teacheradvisory', compact('advisory', 'id'));
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
        $advisory = advisory::findOrFail($id);
        $advisory->gradeLevel = $request->gradeLevel;
        $advisory->className = $request->className;
        $advisory->employee_id = $request->employee_id;
        $advisory->save();
        return response()->json($advisory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $advisory = advisory::findOrFail($id);
        $advisory->delete();
        return response()->json($advisory);
    }

    public function fetch(Request $request)
    {
      $select = $request->get('select');
      $value = $request->get('value');
      $dependent = $request->get('dependent');
      $data = DB::table('yearlevels')
                  ->where($select, $value)
                  ->groupBy($dependent)
                  ->get();
      $output = '<option value="" selected disabled>-Select Class Name- </option>';
      foreach($data as  $row)
      {
        $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
      }
      echo $output;
    }

    
}
