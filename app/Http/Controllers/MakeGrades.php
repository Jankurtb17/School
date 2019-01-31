<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\users;
use DB;
use App\firstgrading;
use Illuminate\Support\Facades\Crypt;
class MakeGrades extends Controller
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
      return view('teacher.studentgrades');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('teacher.studentgrades');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $student = $request->get('student_id');
      $subjectCode = $request->get('subjectCode');
      $gradingperiod = $request->get('gradingperiod');
      $grade = $request->get('grade');
      $gradeLevel = $request->get('gradeLevel');
      $schoolYear = $request->get('schoolYear');
      $className = $request->get('className');
      
      $data = firstgrading::where('subjectCode', $subjectCode)
                          ->where('gradingperiod', $gradingperiod)
                          ->count();
      if($gradingperiod == 1)
      {
       
      if($data > 0){
        return redirect('/subjectload')->with('error', 'already encoded! ');
      }
      else{
       
        foreach($student as $students => $key)
          {
              $datas[] = array(
                  "student_id"       =>$student[$students],
                  "gradeLevel"       =>$gradeLevel[$students],
                  "schoolYear"       =>$schoolYear,
                  "gradingperiod"    =>'1',
                  "className"        =>$className,
                  "subjectCode"      =>$subjectCode,
                  "grade"            =>$grade[$students],
                  "employee_id"      =>Auth()->user()->employee_id
              );
            
            }
           
            DB::table('firstgradings')->insert($datas);
              return redirect('/subjectload')->with('notif', 'successfully added! ');
          }
      }
      elseif($gradingperiod == 2){
        if($data > 0){
          return redirect('/subjectload')->with('error', 'already encoded! ');
        }
        else{
          foreach($student as $students => $key)
            {
                $datas[] = array(
                    "student_id"       =>$student[$students],
                    "gradeLevel"       =>$gradeLevel[$students],
                    "schoolYear"       =>$schoolYear,
                    "gradingperiod"    =>'2',
                    "className"        =>$className,
                    "subjectCode"      =>$subjectCode,
                    "grade"            =>$grade[$students],
                    "employee_id"      =>Auth()->user()->employee_id

                );
              }
              DB::table('firstgradings')->insert($datas);
                return redirect('/subjectload')->with('notif', 'successfully added! ');
            }
        }
        elseif($gradingperiod == 3){
          if($data > 0){
            return redirect('/subjectload')->with('error', 'already encoded! ');
          }
          else{
            foreach($student as $students => $key)
              {
                  $datas[] = array(
                      "student_id"       =>$student[$students],
                      "gradeLevel"       =>$gradeLevel[$students],
                      "schoolYear"       =>$schoolYear,
                      "gradingperiod"    =>'3',
                      "className"        =>$className,
                      "subjectCode"      =>$subjectCode,
                      "grade"            =>$grade[$students],
                      "employee_id"      =>Auth()->user()->employee_id

                  );
                }
                DB::table('firstgradings')->insert($datas);
                  return redirect('/subjectload')->with('notif', 'successfully added! ');
              }
          }
          elseif($gradingperiod == 4){
            if($data > 0){
              return redirect('/subjectload')->with('error', 'already encoded! ');
            }
            else{
              foreach($student as $students => $key)
                {
                    $datas[] = array(
                        "student_id"       =>$student[$students],
                        "gradeLevel"       =>$gradeLevel[$students],
                        "schoolYear"       =>$schoolYear,
                        "gradingperiod"    =>'4',
                        "className"        =>$className,
                        "subjectCode"      =>$subjectCode,
                        "grade"            =>$grade[$students],
                        "employee_id"      =>Auth()->user()->employee_id
                    );
                  }
                  DB::table('firstgradings')->insert($datas);
                    return redirect('/subjectload')->with('notif', 'successfully added! ');
                }
            }

      

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
    public function edit($studentgrade)
    {
      $user = User::find($studentgrade);
     return view('teacher.studentgrades', compact('user'));
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

    public function test($studentgrade, $classname)
    {   
      $encrypt = Crypt::encryptString($studentgrade);
      $decrypt = Crypt::decryptString($encrypt);
      $advisory = DB::table('advisories')
                ->where('employee_id', Auth()->user()->employee_id)
                ->where('gradeLevel', '=', $decrypt)
                ->where('className', '=', $classname)
                ->get();
      // $subject = DB::table('search_subjects')
              
        $user = DB::table('users')
                    ->where('gradeLevel','=', $decrypt)
                    ->get();
        return view('teacher.studentgrades', compact('user', 'advisory'));
    }
}
