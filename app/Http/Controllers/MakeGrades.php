<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\users;
use DB;
use App\firstgrading;
use App\sendgradeadmin;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\schoolyear;
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
      
      $data = sendgradeadmin::where('subjectCode', $subjectCode)
                          ->where('gradingperiod', $gradingperiod)
                          ->where('className', $className)
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
           
            DB::table('sendgradeadmins')->insert($datas);
              return redirect('/subjectload')->with('notif', 'successfully encoded! ');
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
              DB::table('sendgradeadmins')->insert($datas);
                return redirect('/subjectload')->with('notif', 'successfully encoded! ');
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
                DB::table('sendgradeadmins')->insert($datas);
                  return redirect('/subjectload')->with('notif', 'successfully encoded! ');
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
                  DB::table('sendgradeadmins')->insert($datas);
                    return redirect('/subjectload')->with('notif', 'successfully encoded! ');
                }
            }
            elseif($gradingperiod == 'final'){
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
                          "gradingperiod"    =>'final',
                          "className"        =>$className,
                          "subjectCode"      =>$subjectCode,
                          "grade"            =>$grade[$students],
                          "employee_id"      =>Auth()->user()->employee_id
                      );
                    }
                    DB::table('sendgradeadmins')->insert($datas);
                      return redirect('/subjectload')->with('notif', 'successfully encoded! ');
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
    public function edit($id)
    {
      $student = sendgradeadmin::findOrFail($id);
      return view('/viewteacher', compact('student', 'id'));
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
      $student = sendgradeadmin::findOrFail($id);
      $student->grade = $request->get('grade');
      $student->save();
      return redirect('/teacher')->with('update', 'Successfully Updated!');
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

    public function test($studentgrade, $classname, $subject)
    {   
      $advisory = DB::table('advisories')
                ->join('search_subjects', 'advisories.subjectCode', '=', 'search_subjects.subjectCode')
                ->where('advisories.employee_id', Auth()->user()->employee_id)
                ->where('search_subjects.gradeLevel', '=', $studentgrade)
                ->where('advisories.subjectCode', '=', $subject)
                ->groupBy('search_subjects.subjectCode')
                ->get();
       $date = Carbon::now('Asia/Taipei')->toDateString();
       $exam = DB::table('exams')
                  ->get();
       $schoolyear = schoolyear::all();
              
        $user = DB::table('users')
                    ->where('gradeLevel','=', $studentgrade)
                    ->where('className', '=', $classname)
                    ->get();
        return view('teacher.studentgrades', compact('schoolyear','user', 'advisory', 'date', 'exam'));
    }
 
}
