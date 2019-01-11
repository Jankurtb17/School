<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
  <title>Document</title>
</head>
<body>
    @include('Pages.sidebar')
    @can('isAdmin')
        <div class="content">
          <div class="sidebar-content">
          </div>
          <div class="title">
            <h1>Dashboard </h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"> <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</li>
              </ol>
            </nav>
          </div>
          <div class="card-deck">
            <div class="card">
              <div class="card-body">
                <div class="dash-icon d-flex justify-content-center pt-4 bg-primary">
                    <i class="fa fa-lock" aria-hidden="true" id="dashboard-icon"></i>
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
                    <i class="fa fa-users" aria-hidden="true" id="dashboard-icon"></i>
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
                  <i class="fa fa-users" aria-hidden="true" id="dashboard-icon"></i>
              </div>
              <div class="dash-header">
                <h5 class="card-title">  Student </h5>
                <p class="card-text"> 20 </p>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="dash-icon d-flex justify-content-center pt-4 bg-dark">
                  <i class="fa fa-book" aria-hidden="true"  id="dashboard-icon"></i>
              </div>
              <div class="dash-header">
                <h5 class="card-title">  Class </h5>
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
  @endCan
  <script src="{{ asset('js/app.js') }}"></script>
  <script type="text/javascript">
    $('nav-item').on('click', 'nav-link', function(){
        $('.nav-item nav-link.active').removeClass('current');
        $(this).addClass('current');
    }); 
  </script>
</body>
</html>