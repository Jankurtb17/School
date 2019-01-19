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
          <div class="title">
            <h1>Subject Load</h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-tachometer" aria-hidden="true" id="dashboard-icon"> </i> <a href="/dashboard">Dashboard </a></li>
                <li class="breadcrumb-item active" aria-current="page">Students</li>
              </ol>
            </nav>
          </div>
          <div class="card">
            <div class="card-body">
              <form action="{{ route('student.search')}}" method="GET" id="form-horizontal">
                @csrf
                <div class="row">
                  <div class="col-lg-2">
                    <select name="schoolYear" class="form-control" id ="schoolYear" required>
                      <option value="" selected disabled>-Select School Year-</option>
                      @foreach ($schoolyear as $schoolyears)
                         <option value="{{ $schoolyears->schoolYear }}">{{ $schoolyears->schoolYear }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-lg-2">
                      <select name="gradeLevel" class="form-control dynamic" id ="gradeLevel" data-dependent="className" required>
                        <option value="" selected disabled>-Select Grade Level-</option>
                        @foreach ($advisory as $advisories)
                           <option value="{{ $advisories->gradeLevel }}">{{ $advisories->gradeLevel }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="col-lg-2">
                    <select name="className" class="form-control"  id ="className" required>
                      <option value="">-Select Section-</option>
                    </select>
                  </div>
                  <div class="col-lg-2">
                    <button class="btn btn-primary" type="submit">Search</button>
                  </div>
                </div>
              </form>
              <table class="table table-bordered table-hover mt-4">
                <thead>
                    <tr>
                      <th>Student Number</th>
                      <th>First Name</th>
                      <th>Middle Initial</th>
                      <th>Last Name</th>
                    </tr>
                </thead>
                <tbody>
                  
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
    $(document).on('change', '.dynamic', function() {
      if($(this).val() != '')
      {
        select = $(this).attr("id");
        value = $(this).val();
        dependent =  $(this).data('dependent');
        _token = $('input[name="_token"]').val();
        $.ajax({
          url: "{{ route('classname.search') }}",
          method: "POST",
          data: {
            select: select,
            value: value,
            _token: _token,
            dependent:dependent
          },
          success:function(result)
          {
            $('#'+dependent).html(result);
          }
       });
      }
    }); 

    $(document).on('submit', 'form', function(e) {
      e.preventDefault();
        $.ajax({
          url: "{{ route('student.search') }}",
          method: "GET",
          data: {
            "_token": $('input[name="_token"]').val(),
            "gradeLevel": $('#gradeLevel').val(),
            "className": $('#className').val()
          },
          success:function(data)
          {
            $('tbody').html(data);
          }
        });
    });
  </script>
</body>
</html>
@endCan