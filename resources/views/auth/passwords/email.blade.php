@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
      <div class="row justify-content-center">
        <div class="col-md-7">
          <div class="login-view">
        
          </div>
        </div>

        <div class="col-md-5">
          <div class="overlay2">
            <div class="overlay-1">
              <h2> Reset Password </h2>
            </div>
            <div class="overlay-3">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf

                        <div class="form-group row" id="reset">
                            <div class="input-group">
                               <div class="input-group-prepend">
                                  <span class="input-group-text">
                                    <i class="fa fa-envelope"></i>
                                  </span>
                               </div>
                                <input id="email" type="email" class="col-lg-7 email form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex">
                          <button type="button" class="el-button--text float-left col-lg-4 mr-5">
                            <span><a href="/login" >Login</a></span>
                          </button>
                          <button id="password-reset " type="submit" class="btn btn-primary float-right">
                             <span> Send Password </span>
                          </button>
                            
                        </div>

                        
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
