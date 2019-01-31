<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\schoolyear;
use App\search_subjects;
use DB;

class StudentGrades extends Controller
{
    public function index()
    {
      $schoolyear = schoolyear::all();
      return view('student.studentgrades', compact('schoolyear'));
    }

    public function showGrades(Request $request)
    {
      $output = '';
      $gradingperiod = $request->get('gradingPeriod');
      $schoolyear = $request->get('schoolYear');
      $search = DB::table('firstgradings')
                  ->join('search_subjects', 'firstgradings.subjectCode', '=', 'search_subjects.subjectCode')
                  ->where('gradingperiod', $gradingperiod)
                  ->where('schoolYear', $schoolyear)
                  ->where('student_id', Auth()->user()->student_id)
                  ->get();
      $count = count($search);
      if($count > 0)
      {
          foreach($search as $row)
          {
            $output .= '
              <thead align="center">
                <tr>
                  <th>Subject Code <th>
                  <th>Subject Description <th>
                  <th>Instructor <th>
                  <th>Grade <th>
                </tr>
              </thead>
              <tbody align="center">
                  <tr>
                    <td>'.$row->subjectCode.'</td>
                    <td>'.$row->description.'</td>
                    <td>'.$row->employee_id.'</td>
                    <td>'.$row->grade.'</td>
                  </tr>
              </tbody>
                  ';
          }
          return response()->json($output);
      }
      else {
        $output = '<tr> <td colspan="5">No results were found </td> </tr>';
        return response()->json($output);
      }
    }
}
