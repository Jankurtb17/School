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
      $teacher = DB::table('users')
              ->where('role_id', 3)
              ->count();
        $student = DB::table('users')
              ->where('role_id', 1)
              ->count();
      $user = DB::Table('Users')
                ->where('role_id', 3)
                ->get();
      $advisory = DB::table('advisories')
                    ->join('users', 'advisories.employee_id', '=', 'users.employee_id')
                    ->select('users.*','advisories.*')
                    ->get();
      $yearlevel = DB::table('yearlevels')
                      ->get();
      $schoolyear = DB::table('schoolyears')
                      ->get();
      $subjects = DB::table('search_subjects')
                      ->orderBy('subjectCode', 'ASC')
                      ->get();
     
      return view('Dashboard.teacheradvisory', compact('subjects','user', 'schoolyear','advisory', 'yearlevel', 'student', 'teacher'));
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
     * @param  \Illuminate\Http\Request  $requestvi
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // $employee_id = $request->get('employee_id');
      // $subjectCode = $request->get('subjectCode');
      // $gradeLevel = $request->get('gradeLevel');
      // $schoolyear = $request->get('schoolYear');
      $this->validate($request, [
        'schoolYear'  =>  'required|string',
        'gradeLevel'  =>  'required|string',
        'className'  =>  'required|string',
        'employee_id' =>  'required|string',
        'subjectCode' =>  'required|string',
      ]);
     
      $subjectCode = $request->get('subjectCode');

      $advisory = advisory::where('subjectCode', $subjectCode)
                            ->count();
      if($advisory > 0 )
      {
      return redirect('/advisory')->with('errors', 'Already Taken!');
      }
      else
      { 
        advisory::create([
          'user_id'     =>Auth::id(),
          'schoolYear'  =>$request->get('schoolYear'),
          'gradeLevel'  =>$request->get('gradeLevel'),
          'className'   =>$request->get('className'),
          'employee_id' =>$request->get('employee_id'),
          'subjectCode' =>$request->get('subjectCode'),
      ]);
      }
        

      return redirect('/advisory')->with('success', 'successfully added!');
       
        
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
        $advisory->schoolYear = $request->schoolYear;
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
      $output = '<option value="" selected disabled>-Select '.ucfirst($dependent).'- </option>';
      foreach($data as  $row)
      {
        $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
      }
      echo $output;
    }

    public function getclass(Request $request)
    {
      $select = $request->get('select');
      $value = $request->get('value');
      $dependent = $request->get('dependent');
      $data = DB::table('yearlevels')
                  ->where($select, $value)
                  ->groupBy($dependent)
                  ->get();
      $output = '<option value="" selected disabled>-Select '.ucfirst($dependent).'- </option>';
      foreach($data as  $row)
      {
        $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
      }
      return response()->json($output);
    }

    

    
}
