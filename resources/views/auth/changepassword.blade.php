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
                      <form id="horizontal" action="{{ route('change.info', ['id' => Auth()->user()->id] )}}" method="POST">
                        @csrf
                        <div class="form-group">
                          <h5 class="display-5">EDIT PROFILE </h5>
                        </div>
                        
                        @if(session()->has('updated'))
                        <div class="alert alert-success changepass-alert">
                            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times; </button>
                            <strong> User Information </strong> {{ session()->get('updated')}}
                        </div>
                      @endif

                        <div class="form-group" id="form-group">
                            <div class="row">
                              <Label class="col-lg-3">First Name</Label>
                              <input  type="text" class="form-control col-lg-8" name="firstName" id="firstName" value="{{ Auth()->user()->firstName }}">
                            </div>
                        </div>

                        <div class="form-group" id="form-group">
                            <div class="row">
                              <Label class="col-lg-3">Last Name</Label>
                              <input  type="text" class="form-control col-lg-8" name="lastName" id="lastName" value="{{ Auth()->user()->lastName }}">
                            </div>
                        </div>

                        <div class="form-group" id="form-group">
                            <div class="row">
                              <Label class="col-lg-3">Middle Name</Label>
                              <input  type="text" class="form-control col-lg-8" name="middleName" id="middleName" value="{{ Auth()->user()->middleName }}">
                            </div>
                        </div>

                        <div class="form-group" id="form-group">
                            <div class="row">
                              <Label class="col-lg-3">Contact Number</Label>
                              <input  type="text" class="form-control col-lg-8" name="phone_number" id="contactNumber" value="{{ Auth()->user()->phone_number }}">
                            </div>
                        </div>

                        <div class="form-group" id="form-group">
                            <div class="row">
                              <Label class="col-lg-3">Address</Label>
                            <input  type="text" class="form-control col-lg-8" name="address" id="Address" value="{{ Auth()->user()->address}}">
                            </div>
                        </div>

                        <div class="form-group" id="form-group">
                            <div class="row">
                            <div class="col-lg-3"> </div>
                            <button type="submit" class="btn btn-primary col-lg-8" id="changepassButton">Edit</button>
                            </div>
                        </div>

                      </form>
                  </div>
                </div>
              </div>
              
          <div class="col-lg-6">
            <div class="card" id="changepassword">
              <div class="card-body">

              
                  <form class="form-horizontal" method="POST"action="{{ route('changePassword')}}" id="horizontal">
                    @csrf
                  
                    @if(session()->has('success'))
                    <div class="alert alert-success changepass-alert">
                        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times; </button>
                        <strong> Password </strong> {{ session()->get('success')}}
                    </div>
                  @endif
  
                  @if(session()->has('error'))
                    <div class="alert alert-danger changepass-alert">
                        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times; </button>
                        <strong> Password </strong> {{ session()->get('error')}}
                    </div>
                  @endif
                  <div class="form-group">
                      <h5 class="display-5">CHANGE PASSWORD</h5>
                  </div>
                    <div class="form-group{{ $errors->has('current-password') ? 'has-error' : ''}}" id="form-group">
                      <div class="row">
                        <Label class="col-lg-3 control-label">Current Password</Label>
                        <input  type="password" class="form-control col-lg-8" name="current-password">
                        @if ($errors->has('current-password'))
                          <span class="help-block">
                            <strong>{{ $errors->first('current-password') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group" id="form-group">
                        <div class="row">
                          <Label class="col-lg-3">New Password</Label>
                          <input id="password" type="password" class="form-control col-lg-8" name="new-password">
                          @if ($errors->has('new-password'))
                            <span class="help-block">
                              <strong>{{ $errors->first('new-password') }}</strong>
                            </span>
                          @endif
                        </div>
                    </div>

                    <div class="form-group" id="form-group">
                        <div class="row">
                          <Label class="col-lg-3">Confirm Password</Label>
                          <input id="password-confirm" type="password" class="form-control col-lg-8" name="new-password_confirmation">
                        </div>
                    </div>

                    <div class="form-group" id="form-group">
                        <div class="row">
                        <div class="col-lg-3"> </div>
                        <button type="submit" class="btn btn-primary col-lg-8" id="changepassButton2">Change Password</button>
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