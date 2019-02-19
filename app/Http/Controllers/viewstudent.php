<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class viewstudent extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function sendGrade(Request $request)
    {
      //
      $student_id = $request->get('student_id');
      $grade = $request->get('student_id');
      $phone_number = $request->get('student_id');
      $subjectCode = $request->get('subjectCode');

      foreach($phone_number as $contact => $key)
      {
        $data[] = array(
          'grade'         =>$grade[$contact],
          'subject'  =>$phone_number[$contact],
        );
      }
      
      $nexmo = app('Nexmo\Client');

      $nexmo->message()->send([
          'to'   => $phone_number,
          'from' => '639565011210',
          'text' =>  $data
      ]);
            
      return redirect('/viewgrades')->with('success', 'Successfully Send!');

    }
}
