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
              <div class="overlay-main">
                <div class="overlay-reset">
                  <h2> Reset Password </h2>
                </div>
                <div class="overlay-body">
                    <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group" id="reset">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                  <i class="fa fa-envelope"></i>
                              </span>
                            </div>
                            <input id="email" type="email" class="col-lg-8 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="Email" required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>

                          <div class="form-group" id="reset">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-lock"></i>
                                </span>
                              </div>
                              <input id="password" type="password" class="col-lg-8 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                              @if ($errors->has('password'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                            </div>
                          </div>

                          <div class="form-group" id="reset">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-lock"></i>
                                </span>
                              </div>
                            <input id="password-confirm" type="password" class="col-lg-8 form-control" name="password_confirmation" placeholder="Confirm Password" required>
                          </div>

                        <div class="form-group row mb-0 d-flex" id="button">
                          <button type="submit" class="btn btn-primary ">
                              RESET PASSWORD
                          </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
