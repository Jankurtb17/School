<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\User;
use Nexmo\Laravel\Facade\Nexmo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $admin = DB::table('users')
                  ->where('role_id', 2)
                  ->count();
      $teacher = DB::table('users')
                  ->where('role_id', 3)
                  ->count();
      $student = DB::table('users')
                  ->where('role_id', 1)
                  ->count();
      return view('Dashboard.home', compact('admin', 'teacher', 'student'));
    }

    public function dashboard()
    {
      $admin = DB::table('users')
      ->where('role_id', 2)
      ->count();
      $teacher = DB::table('users')
            ->where('role_id', 3)
            ->count();
      $student = DB::table('users')
            ->where('role_id', 1)
            ->count();
return view('Dashboard.home', compact('admin', 'teacher', 'student'));
    }

    public function teacherDashboard()
    {
      return view('teacher.dashboard');
    }
    
    public function welcome()
    {
      return view('dashboard.welcome');
    }
    
    public function dashboard2() 
    {
      
      return view('Dashboard.sidebar');  
    }
    public function showChangePasswordForm()
    {
      return view('auth.changepassword');
    }
  
}
