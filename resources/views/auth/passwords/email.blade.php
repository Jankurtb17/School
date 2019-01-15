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
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="email form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button id="password-reset" type="submit" class="btn btn-primary">
                                    {{ __('Send Password') }}
                                </button>
                            </div>
                        </div>

                        <div class="form-group row mt-4 ">
                          <div class="col-md-6 offset-md-4">
                            <a href="/login">Login</a>
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
