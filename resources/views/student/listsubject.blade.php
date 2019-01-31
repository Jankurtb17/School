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
          <div class="card" id="card-subjectgrade">
            <div class="card-body">
              <div class="title">
                <h1>List of Subjects</h1>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <ion-icon name="speedometer" id="dashboard-icon"> </ion-icon> <a href="/dashboard">Dashboard </a></li>
                    <li class="breadcrumb-item active" aria-current="page">List of Subject</li>
                  </ol>
                </nav>
              </div>
                
                
                <div class="table-wrapper-scroll-y">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Subject Code</th>
                        <th>Subject Description</th>
                        <th>Remarks </th>
                      </tr>
                    </thead>
                    <tbody>
                      <td colspan="3" id="level"><strong>Grade 1 </strong></td>
                      @foreach ($grade1 as $grade1s)
                        <tr>
                          <td>{{ $grade1s->subjectCode}}</td>
                          <td>{{ $grade1s->description}}</td>
                          <td></td>
                        </tr>
                      @endforeach
                      <td colspan="3" id="level"><strong>GRADE 2 </strong></td>
                      @foreach ($grade2 as $grade2s)
                        <tr>
                          <td>{{ $grade2s->subjectCode}}</td>
                          <td>{{ $grade2s->description}}</td>
                          <td></td>
                        </tr>
                      @endforeach
                      
                    <td colspan="3" id="level">Grade 3</td>
                    @foreach ($grade3 as $grade3e)
                    <tr>
                      <td>{{ $grade3e->subjectCode}}</td>
                      <td>{{ $grade3e->description}}</td>
                      <td></td>
                    </tr>
                  @endforeach
                    </tbody>
                  </table>
              </div>
          </div>
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