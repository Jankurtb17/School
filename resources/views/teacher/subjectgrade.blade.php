@extends('layouts.admin')


@section('content')
  @include('Pages.sidebar')
  @can('isTeacher')
  
        <div class="content">
          <div class="sidebar-content">
          </div>
          
          <div class="card" id="card-subjectgrade">
            <div class="card-body">
          <div class="title">
            <h1>Grade Encoding</h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-tachometer" aria-hidden="true" id="dashboard-icon"> </i> <a href="/dashboard">Dashboard </a></li>
                <li class="breadcrumb-item active" aria-current="page"> Grade Encoding</li>
              </ol>
            </nav>
          </div>
         
    
              <form action="{{ route('student.search')}}" method="GET" id="form-horizontal">
                @csrf
                <div class="row">
                  <div class="col-lg-2">
                    <select name="schoolYear" class="form-control dynamic" id ="schoolYear" data-dependent="gradeLevel" required>
                      <option value="" selected disabled>-Select School Year-</option>
                      @foreach ($advisory as $advisories)
                         <option value="{{ $advisories->schoolYear }}">{{ $advisories->schoolYear }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-lg-2">
                      <select name="gradeLevel" class="form-control dynamic" id ="gradeLevel" data-dependent="className" required>
                        <option value="" selected disabled>-Select Grade Level-</option>
                      </select>
                  </div>
                  <div class="col-lg-2">
                    <select name="className" class="form-control"  id ="className" required>
                      <option value="">-Select Section-</option>
                    </select>
                  </div>
                  <div class="col-lg-2">
                    <button class="addButton" type="submit">Search</button>
                  </div>
                </div>
              </form>
              <form method="POST" id="form-submit" action="{{ route("subjectgrade.grade")}}">
                @csrf
              <table class="table table-bordered table-hover mt-4">
                <thead align="center">
                    <tr>
                      <th>Student Number</th>
                      <th>Student Full Name</th>
                      <th>Input Grade</th>
                    </tr>
                </thead>
                <tbody align="center">
                  
                </tbody>
              </table>  
                
                <button type="submit" class="btn btn-success">Submit</button>
              </form>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
    $('#form-submit').on('submit', function() {
        $.ajax({
            url: '{{ route("subjectgrade.grade")}}',
            type: 'POST',
            data: {
              "_token": $('input[name=_token]').val(),
              "student_id":  $('input[name=student_id]').val(),
              "grade":  $('input[name=grade]').val()
            },
            success:function(data) {
               alert('Successsfully Added!');
            }
        });
    });
    $('body').ready(function() {
       $('.btn-success').hide();
    }); 
    
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
            $('.btn-success').show();

          }
        });
    });
  </script>
@endCan
@endsection