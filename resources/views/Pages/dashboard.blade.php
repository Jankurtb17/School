<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
  <title>Document</title>
</head>
<body>

  <div class="app-body">
    <div class="sidebar">
      <div class="sidebar-content">
          <nav class="sidebar-nav">
            <ul class="nav">
              <div class="main-content">
                Admin
              </div>
              <li class="nav-item">
                  <a class="nav-link" href="/dashboard"> <ion-icon name="speedometer" id="icon-dashboard"></ion-icon> Dashboard </a>
              </li>
              <li class="nav-title"> Module </li>
              <li class="nav-item">
                  <a class="nav-link" href="#"> <ion-icon name="document" id="icon-dashboard"></ion-icon>  Class Info </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> <ion-icon name="contacts" id="icon-dashboard"></ion-icon>  Teachers </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> <ion-icon name="person" id="icon-dashboard"></ion-icon>  Student </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> <ion-icon name="stopwatch" id="icon-dashboard"></ion-icon>  Schedule </a>
              </li>
              <li class="nav-title"> Settings </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> <ion-icon name="settings" id="icon-dashboard"></ion-icon>  Account Settings </a>
              </li>
            </ul>
          </nav>
      </div>
    </div>

    <div class="main">
      <div class="navbar-top">
          <ul class="navbar-nav">
            @if (isset(Auth::user()->name))
              <li>
                <a data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                  {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu">
                <a class="dropdown-item" href=" {{ url('/logout') }}">
                    Logout
                  </a>
                </div>
              </li>
            @else
              <script>
                window.location = '/logout';
              </script>
            @endif
          </ul>
      </div>
      
      <div class="content">
        <div class="sidebar-content">
        </div>
        <div class="title">
          <h1>Dashboard </h1>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page"><ion-icon name="speedometer" id="dashboard-icon"> </ion-icon>Dashboard</li>
            </ol>
          </nav>
        </div>
        <div class="card-deck">
          <div class="card">
            <div class="card-body">
              <div class="dash-icon d-flex justify-content-center pt-4 bg-primary">
                <ion-icon name="hand" id="dashboard-icon"></ion-icon>
              </div>
              <div class="dash-header">
                <h5 class="card-title">  Admin </h5>
                <p class="card-text"> 1 </p>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="dash-icon d-flex justify-content-center pt-4 bg-danger">
                  <ion-icon name="people" id="dashboard-icon"></ion-icon>
              </div>
              <div class="dash-header">
                <h5 class="card-title">  Teacher </h5>
                <p class="card-text"> 20 </p>
              </div>
            </div>
          </div>
        <div class="card">
          <div class="card-body">
            <div class="dash-icon d-flex justify-content-center pt-4 bg-success">
                <ion-icon name="people" id="dashboard-icon"></ion-icon>
            </div>
            <div class="dash-header">
              <h5 class="card-title">  Teacher </h5>
              <p class="card-text"> 20 </p>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="dash-icon d-flex justify-content-center pt-4 bg-dark">
                <ion-icon name="people" id="dashboard-icon"></ion-icon>
            </div>
            <div class="dash-header">
              <h5 class="card-title">  Teacher </h5>
              <p class="card-text"> 20 </p>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
    </div>
  </div>
  </div>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://unpkg.com/ionicons@4.4.6/dist/ionicons.js"></script>
</body>
</html>