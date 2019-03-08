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

    public function archieve()
    {
      $teacher = DB::table('users')
                  ->where('role_id', 3)
                  ->count();
      $student = DB::table('users')
                  ->where('role_id', 1)
                  ->count();
      $grades = DB::table('sendgradeadmins')
                  ->join('search_subjects', 'sendgradeadmins.subjectCode', '=', 'search_subjects.subjectCode')
                  ->join('users', 'users.student_id', '=', 'sendgradeadmins.student_id')
                  ->select('search_subjects.subjectCode', 'search_subjects.description', 'users.student_id', 'users.firstName', 'users.lastName', 'users.middleName','sendgradeadmins.*')
                  ->get();
      return view('Dashboard.archieve', compact('grades', 'student', 'teacher'));
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
    
    public function showChangePasswordForm()
    {
      return view('auth.changepassword');
    }
  
}
