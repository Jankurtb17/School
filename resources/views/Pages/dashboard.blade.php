<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <title>Document</title>
</head>
<body>

  <div class="app-body">
    <div class="sidebar">
      <nav class="sidebar-nav">
        <ul class="nav">
          <li class="nav-item">
              <a class="nav-link" href="/dashboard"> <ion-icon name="speedometer"></ion-icon> Dashboard </a>
          </li>
          <li class="nav-title"> Module </li>
          <li class="nav-item">
              <a class="nav-link" href="#"> <ion-icon name="contacts"></ion-icon>  Reports </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"> <ion-icon name="contacts"></ion-icon>  Teachers </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"> <ion-icon name="contacts"></ion-icon>  Student </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"> <ion-icon name="stopwatch"></ion-icon>  Schedule </a>
          </li>
          <li class="nav-title"> Settings </li>
          <li class="nav-item">
            <a class="nav-link" href="#"> <ion-icon name="settings"></ion-icon>  Account Settings </a>
          </li>
          
        </ul>
      </nav>
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
                  <a class="dropdown-item" href="#">
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
        <div class="title">
          <h1>Dashboard </h1>
        </div>
        <div class="card-deck">
          <div class="card">
            <div class="card-body">
              <div class="dash-header">
                <h5 class="card-title">  Teacher </h5>
                <p class="card-text"> 20 </p>
              </div>
              <div class="dash-icon">
                <ion-icon name="people" id="dashboard-icon"></ion-icon>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="dash-header">
                <h5 class="card-title">  Teacher </h5>
                <p class="card-text"> 20 </p>
              </div>
              <div class="dash-icon">
                <ion-icon name="people" id="dashboard-icon"></ion-icon>
              </div>
            </div>
          </div>
        <div class="card">
          <div class="card-body">
            <div class="dash-header">
              <h5 class="card-title">  Teacher </h5>
              <p class="card-text"> 20 </p>
            </div>
            <div class="dash-icon">
              <ion-icon name="people" id="dashboard-icon"></ion-icon>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="dash-header">
              <h5 class="card-title">  Teacher </h5>
              <p class="card-text"> 20 </p>
            </div>
            <div class="dash-icon">
              <ion-icon name="people" id="dashboard-icon"></ion-icon>
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