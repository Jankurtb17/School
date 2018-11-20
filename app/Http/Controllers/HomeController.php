<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
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
      return view('Pages.Login');
    }

    public function dashboard()
    {
      return view('Dashboard.home');
    }

    public function class()
    {
      return view('Dashboard.class');
    }

    public function teacher()
    {
      return view('Dashboard.teacher');
    }

    public function student()
    {
      return view('Dashboard.student');
    }

    public function schoolYear()
    {
      return view('Dashboard.schoolYear');
    }

    public function yearLevel()
    {
      return view('Dashboard.yearLevel');
    }

    public function studentClass()
    {
      return view('Dashboard.studentclass');
    }

    public function advisory()
    {
      return view('Dashboard.teacheradivsory');
    }

    public function subject()
    {
      return view('Dashboard.subject');
    }

    public function pasok()
    {
      return view('Dashboard.class');
    }

    public function logout(Request $request)
    {
      Auth::logout();
    $request->session()->invalidate();
    return redirect('/login');
    }
    
}
