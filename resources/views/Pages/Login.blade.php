@extends('Login.index')

@section('content')
<div class="card">
  <div class="row">
    <div class="col-md-7 col-sm-7 col-xs-12">
      <div class="login-view">

      </div>
    </div>

    <div class="col-md-5 col-sm-5 col-xs-12">
      <div class="overlay">
        <div class="overlay-1">
          <h1>Login </h1>
        </div>

        @if(isset(Auth::user()->email))
          <script>window.location='/dashboard';</script>
        @endif

        @if($message = Session::get('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">&times; 
            <strong>{{ $message }}</strong>
            </button>
          </div>
        @endif

        @if(count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li> {{ $error }} </li>
              @endforeach
            </ul>
          </div>
        @endif

        <div class="overlay-2">
        <form method="POST" action="{{ url('/checkLogin')}}">
          @csrf
            <div class="form-group">
              <input type="text"  placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <a href="#">Forgot Password? </a>
              </div>
            <div class="form-group">
              <button type="submit" name="submit"> Login </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
