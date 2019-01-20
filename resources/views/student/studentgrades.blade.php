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
  <title>Grades</title>
</head>
<body>
  @include('Pages.sidebar')
  @can('isStudent')
        <div class="content">
          <div class="sidebar-content">
          </div>
          <div class="title">
            <h1>Grades</h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"> <ion-icon name="speedometer" id="dashboard-icon"> </ion-icon> <a href="/dashboard">Dashboard </a></li>
                <li class="breadcrumb-item active" aria-current="page">Grades</li>
              </ol>
            </nav>
          
          <div class="card">
            <div class="card-body">
              <form>
                <div class="row">
              
                  <div class="col-lg-2">
                    <select class="form-control" name="period">
                      <option value="" selected disabled>-Grading Period-</option>
                      <option value="1">1st Grading</option>
                      <option value="2">2nd Grading</option>
                      <option value="3">3rd Grading</option>
                      <option value="4">4th Grading</option>
                    </select>
                  </div>
                  <div class="col-lg-2">
                    <select class="form-control" name="schoolYear">
                        <option value="" selected disabled>-School Year-</option>
                        @foreach ($schoolyear as $schoolyears)
                            <option value="{{ $schoolyears->schoolYear }}">{{ $schoolyears->schoolYear }}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group"> 
                    <button type="submit" class="btn btn-primary"> Proceed </button>
                  </div>
                  </form>
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
  <script>

  
  </script>
</body>
</html>