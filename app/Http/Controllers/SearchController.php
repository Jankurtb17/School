<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\advisory;
use App\gradelevels;

class SearchController extends Controller
{
  // public function showAddingForm()
  // {
  //  $gradelevel = gradelevels::all();
  //  $advisory = advisory::all();
  //  return view('Dashboard.teacheradvisory', compact('advisory', 'gradelevel'));
  // }

  // public function fetch(Request $request)
  // {
  //   if($request->get('query'))
  //   {
  //     $query = $request->get('query');
  //     $data = DB::table('users')
  //               ->where('role_id', 3)
  //               ->where('firstName', 'LIKE', "%{$query}%")
  //               ->get();
  //     $output = '<ul class=" dropdown-menu" style="display:block; position:relative; width:100%">';
  //     foreach($data as $row)
  //     {
  //     $output .= '<li class ="nav-item searchItem"><a class="nav-link" href="#">'.$row->firstName.' '.$row->lastName.'</a></li>';
  //     $result ='<input type="hidden" value="'.$row->employee_id.'" name="employee_id">';
  //     }
      
  //     $output .= '</ul>';
  //     echo $output;
  //   }
  // }

  // public function search()
  // {
  //   $advisory = advisory::all();
  //   $gradelevel = DB::table('gradelevels')
  //        ->groupBy('gradeLevel')
  //        ->get();
  //    return view('Dashboard.teacheradvisory', compact('gradelevel', 'advisory'));
  // }

  // public function selectbox(Request $request)
  // {
  //   $select = $request->get('select');
  //   $value  = $request->get('value');
  //   $dependent  = $request->get('dependent');
  //   $data = DB::table('gradelevels')
  //             ->where($select, $value)
  //             ->groupBy($dependent)
  //             ->get();
  //   $output = '<option value="">Select '.ucfirst($dependent).'</option>';
  //   foreach($data as $row)
  //   {
  //       $output .= '<option value="'.$row->dependent.'">'.$row->dependent.'</option>';
  //   }
  //   echo $output;
  // }

}
