<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountSettings extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      return view('Dashboard.changepassword');    
    }

    public function store(Request $request)
    {
      $this->validate($request, [
          'currentPassword'   => 'required|string|current',
          'newPassword'       => 'required|required_with:password_confirmation|confirmed'
      ]);
    }

    public function edit($id)
    {
      return view('Dashboard.changepassword', 'id');    

    }
    public function update(Request $request,  $id)
    {
        
    }
}
