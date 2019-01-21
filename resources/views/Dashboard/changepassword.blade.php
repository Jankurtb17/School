@extends('layouts.admin')


@section('content')

      @include('Pages.sidebar')
      <div class="content">
        <div class="sidebar-content">
        </div>
        
        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="card" id="changepassword2">
                  <div class="card-body">
                      <form id="horizontal">
                        @csrf
                        <div class="form-group">
                          <h5 class="display-5">EDIT PROFILE 
                        </div>

                        <div class="form-group" id="form-group">
                            <div class="row">
                              <Label class="col-lg-3">First Name</Label>
                              <input  type="text" class="form-control col-lg-8" name="currentPassword" id="">
                            </div>
                        </div>

                        <div class="form-group" id="form-group">
                            <div class="row">
                              <Label class="col-lg-3">Last Name</Label>
                              <input  type="text" class="form-control col-lg-8" name="currentPassword" id="">
                            </div>
                        </div>

                        <div class="form-group" id="form-group">
                            <div class="row">
                              <Label class="col-lg-3">Middle Name</Label>
                              <input  type="text" class="form-control col-lg-8" name="currentPassword" id="">
                            </div>
                        </div>

                        <div class="form-group" id="form-group">
                            <div class="row">
                              <Label class="col-lg-3">Contact Number</Label>
                              <input  type="text" class="form-control col-lg-8" name="currentPassword" id="">
                            </div>
                        </div>

                        <div class="form-group" id="form-group">
                            <div class="row">
                              <Label class="col-lg-3">Address</Label>
                              <input  type="text" class="form-control col-lg-8" name="currentPassword" id="">
                            </div>
                        </div>
                        <div class="form-group" id="form-group">
                            <div class="row">
                              <Label class="col-lg-3"></Label>
                              <input  type="text" class="form-control col-lg-8" name="currentPassword" id="">
                            </div>
                        </div>

                        <div class="form-group" id="form-group">
                            <div class="row">
                            <div class="col-lg-3"> </div>
                            <button type="submit" class="btn btn-default col-lg-8" id="changepassButton">Edit</button>
                            </div>
                        </div>

                      </form>
                  </div>
                </div>
              </div>
              
          <div class="col-lg-6">
            <div class="card" id="changepassword">
              <div class="card-body">
                  <form action="" id="horizontal">
                    @csrf
                    <div class="form-group">
                        <h5 class="display-5">CHANGE PASSWORD</h1>
                    </div>
                    
                   
                    <div class="form-group" id="form-group">
                      <div class="row">
                        <Label class="col-lg-3">Current Password</Label>
                        <input  type="password" class="form-control col-lg-8" name="currentPassword" id="">
                      </div>
                    </div>

                    <div class="form-group" id="form-group">
                        <div class="row">
                          <Label class="col-lg-3">New Password</Label>
                          <input id="password" type="password" class="form-control col-lg-8" name="password" id="">
                        </div>
                    </div>

                    <div class="form-group" id="form-group">
                        <div class="row">
                          <Label class="col-lg-3">Confirm Password</Label>
                          <input id="password-confirm" type="password" class="form-control col-lg-8" name="password_confirmation " id="">
                        </div>
                    </div>

                    <div class="form-group" id="form-group">
                        <div class="row">
                        <div class="col-lg-3"> </div>
                        <button type="submit" class="btn btn-default col-lg-8" id="changepassButton">Reset</button>
                        </div>
                    </div>
                  </form>
              </div>
            </div>
          </div>
          
        </div>

      </div>
    </div>
    </div>
  </div>
  </div>
@endsection