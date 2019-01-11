<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\advisory;


class SearchController extends Controller
{
  function showAddingForm()
  {
   $advisory = advisory::all();
   return view('Dashboard.teacheradvisory', compact('advisory'));
  }

  function fetch(Request $request)
  {
   if($request->get('query'))
   {
    $query = $request->get('query');
    $data = DB::table('users')
              ->where('role_id', 3)
              ->where('firstName', 'LIKE', "%{$query}%")
              ->get();
    $output = '<ul class=" dropdown-menu" style="display:block; position:relative; width:100%">';
    foreach($data as $row)
    {
     $output .= '<li class ="nav-item"><a class="nav-link" href="#">'.$row->firstName.' '.$row->lastName.'</a></li>';
    }
    $output .= '</ul>';
    echo $output;
   }
   
   
  }

    
}
