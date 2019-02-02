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
          <div class="overlay">
            <div class="overlay-1">
              <h1> Login </h1>
            </div>
            <div class="overlay-2">
              <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                  @csrf

                  <div class="form-group">
                    <div class="input-group input-group-md">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                              <i class="fa fa-envelope" aria-hidden="true"> </i>
                            </div>
                      </div>
                    <input id="email" type="email" class="col-lg-8 form-control{{ $errors->has('email') ? ' is-invalid' : '' }} no-border" name="email" value="{{ old('email') }}" placeholder ="Email" >
                    @if ($errors->has('email'))
                        <span class="invalid-feedback ml-5" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>
                  </div>

                  <div class="form-group">  
                    <div class="input-group input-group-md">
                      <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa fa-lock" aria-hidden="true"> </i>
                          </div>
                      </div>
                    <input id="password" type="password" class="col-lg-8 form-control{{ $errors->has('password') ? ' is-invalid' : '' }} no-border" name="password" value="{{ old('password') }}"placeholder="Password" >
                    @if ($errors->has('password'))
                        <span class="invalid-feedback ml-5" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                  </div>
                  </div>

                  {{-- <div class="form-group row">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    </div>
                    <div class="form-label">
                      <label class="form-check-label" for="remember">
                          {{ __('Remember Me') }}
                      </label>
                    </div>
                  </div> --}}
                
                  
                  <div class="d-flex">
                    <button type="button" class="el-button--text float-left col-lg-4 mr-2">
                        <span> <a href="{{ route('password.request') }}">Forgot password </a></span>
                      </button>
                      <button class="btn btn-default btn-login " type="submit" name="submit">
                          {{ __('Login') }}
                      </button>
                  </div>


                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
