<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterStudents extends Controller
{    
    use RegistersUsers;
    
    public function __construct(){
      $this->middleware('auth:student');
    }

    public function addStudents() {
      $student = student::all();
      return view('Dashboard.student', compact('student'));
    }

    public function register(Request $request) {
      $this->validate($request, [
            'studentNumber'  =>  'required|string',
            'level'           => 'required|string',
            'first_name'      => 'required|string',
            'last_name'       => 'required|string',
            'contactNumber'   => 'required|string|max:11',
            'email'           => 'required|string|email',
            'username'        => 'required|string|min:5',
            'password'        => 'required_with:password_confirmation|same:password_confirmation|confirmed|alphaNum:8|',
            'password_confirmation'=> 'min:8',
            'address'         => 'required|string',
            'city'            => 'required|string',
            'state'           => 'required|string',
            'country'         => 'required|string',
            'zipcode'         => 'required|string',
            'guardianFname'   => 'required|string',
            'guardianLname'   => 'required|string',
            'guardianContact' => 'required|string|max:11',
        ]);
        $user = student::create([
            'role_id'             =>'2',
            'studentNumber'       =>$request->get('studentNumber'),
            'level'               =>$request->get('level'),
            'firstName'           =>$request->get('firstName'),
            'lastName'            =>$request->get('lastName'),
            'email'               =>$request->get('email'),
            'contactNumber'       =>$request->get('contactNumber'),
            'username'            =>$request->get('username'),
            'password'            =>Hash::make($request->get('password')),
            'address'             =>$request->get('address'),
            'city'                =>$request->get('city'),
            'state'               =>$request->get('state'),
            'country'             =>$request->get('country'),
            'zipCode'             =>$request->get('zipCode'),
            'guardianFname'       =>$request->get('guardianFname'),
            'guardianLname'       =>$request->get('guardianLname'),
            'guardianContact'     =>$request->get('guardianContact'),
        ]);
          return redirect('/students')-with('success', 'Successfully Student added!');
    }
}
