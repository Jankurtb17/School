<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('css/addmodal.css')}}">
  <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
  <title>Document</title>
</head>
<body>
  @include('Pages.sidebar')
  @can('isStudent')
        <div class="content">
          <div class="sidebar-content">
          </div>
          <div class="title">
            <h1>List of Subjects</h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"> <ion-icon name="speedometer" id="dashboard-icon"> </ion-icon> <a href="/dashboard">Dashboard </a></li>
                <li class="breadcrumb-item active" aria-current="page">List of Subject</li>
              </ol>
            </nav>
            
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Subject Code</th>
                  <th>Subject Description</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($subject as $subjects)
                  <tr>
                    <td>{{ $subjects->subjectCode}}</td>
                    <td>{{ $subjects->description}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
           
        </div>
      </div>
    </div>
  </div>
  </div>

  <script src="{{ asset('js/app.js') }}"></script>
  <script>

  
  </script>
</body>
</html>
@endCan