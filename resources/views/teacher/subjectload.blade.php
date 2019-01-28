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
  @can('isTeacher')
        <div class="content">
          <div class="sidebar-content">
          </div>
          <div class="card" id="card-subjectgrade">
          <div class="card-body" >
          <div class="title">
            <h1>Subject Load</h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"> <ion-icon name="speedometer" id="dashboard-icon"> </ion-icon> <a href="/dashboard">Dashboard </a></li>
                <li class="breadcrumb-item active" aria-current="page">Students</li>
              </ol>
            </nav>
            

           <div class="form-group">
              <input type="text" name= "search" class="form-control col-lg-2 float-left mb-2" id="search" placeholder="Search">
              @if(session()->has('notif'))
              <div class="row float-right mr-2">
                <div class="alert alert-success" role="alert">
                    <button class="close" aria-hidden="true" data-dismiss="alert">&times; </button>
                    <strong>Grade</strong> {{session()->get('notif')}}
                </div>
              </div>
              @endif
           </div>

            <div class="table-responsive mt-3">
              <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>School Year</th>
                      <th>Grade Level</th>
                      <th>Class Name</th>
                    </tr> 
                  </thead>

                  <tbody id="tbody">
                    @foreach ($advisory as $advisories)
                        <tr class="post{{ $advisories->id}}">
                          <td>{{$advisories->id}}</td>
                          <td>{{$advisories->schoolYear}}</td>
                          <td>{{$advisories->gradeLevel }}</td>
                          <td><a href="/studentgrades/{{$advisories->gradeLevel}}">{{$advisories->className }}</a></td>
                        </tr>
                    @endforeach
                  </tbody>
              </table>
            </div>


            <div class="mt-2">
              {{-- {{ $advisory->links() }} --}}
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
      $(document).on('keyup', '#search', function() {
        
        $value = $(this).val();
        $.ajax({
          url: "{{ route('search.subject')}}",
          type: "GET",
          data: {
            'search': $value,
            '_token': $('input[name=_token]').val()
          },
          success:function(data) {
              $('tbody').html(data);
          }
        });
      })
  </script>
</body>
</html>