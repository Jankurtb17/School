<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\schoolyear;
use App\user;
use Carbon\Carbon;
class ViewSubjectLoad extends Controller
{ 
    
    
  public function index()
  {
    $advisory = DB::table('advisories')
                    ->where('employee_id', Auth()->user()->employee_id)
                    // ->groupBy('gradeLevel')
                    ->get();

    $exam = DB::table('exams')
                      // ->where('startDate', '>=', Carbon::now())
                      // ->where('endDate', '<=', Carbon::now())
                      ->get();
    $date = Carbon::now();

    return view('teacher.subjectload', compact('advisory', 'exam', 'date'));
  }

    // public function search(Request $request) 
    // {
      
    //   if($request->ajax())
    //   {
    //     $output ='';
    //     $search = $request->get('search');
    //     if($search != '')
    //     {
    //       $data = DB::table('advisories')
    //                   ->where('className', 'LIKE', '%'.$search.'%')
    //                   ->Where('employee_id', Auth()->user()->employee_id)
    //                   ->groupBy('gradeLevel') 
    //                   ->paginate(5);
    //     }
    //     else{
    //       $data = DB::table('advisories')
    //                   ->where('employee_id', Auth()->user()->employee_id)
    //                   ->groupBy('gradeLevel')
    //                   ->paginate(5);
    //     }
    //     $total_row = $data->count();
    //     if($total_row > 0)
    //     {

    //       foreach($data as $row)
    //       {
    //           $output .='
    //           <tr>
    //               <td>'.$row->id.'</td>
    //               <td>'.$row->schoolYear.'</td>
    //               <td>'.$row->gradeLevel.'</td>
    //               <td>  <a href="/">'.$row->className.' </a></td>
    //           </tr>
    //           ';
    //       }
    //     }
    //     else 
    //     {
    //         $output = "<tr>
    //                    <td align='center' colspan='5'> No results were found </td>
    //                   </tr>";
    //     }
       
    //     return response()->json($output);
    //   }

      
    // }
}
