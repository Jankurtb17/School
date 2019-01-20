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
      
      <div class="content">
        <div class="sidebar-content">
        </div>
        <div class="title">
          <h1>Class </h1>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"> <ion-icon name="speedometer" id="dashboard-icon"> </ion-icon> <a href="/dashboard"> Dashboard </a> </li>
              <li class="breadcrumb-item active" aria-current="page"> </ion-icon>Class</li>
            </ol>
          </nav>
          
        </div>
      </div>
    </div>
    </div>
  </div>
  </div>
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>