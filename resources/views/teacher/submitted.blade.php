@extends('layouts.teacher')


@section('content')
        <div class="content">
          <div class="sidebar-content">
          </div>
          
          <div class="card" id="card-subjectgrade">
            <div class="card-body">
          <div class="title">
            <h1>View Submitted Grades</h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-tachometer" aria-hidden="true" id="dashboard-icon"> </i> <a href="/dashboard">Dashboard </a></li>
                <li class="breadcrumb-item active" aria-current="page"> Grade Encoding</li>
              </ol>
            </nav>
          </div>
         
          <form method="POST">
            @csrf
           <input type="hidden" value="{{ Auth()->user()->employee_id}}" name="employee_id" id="employee">
            <div class="row">
              <div class="col-lg-2">
                  <div class="form-group">
                    <select name="schoolYear" id="schoolYear" class="form-control" required>
                        <option value="" selected disabled>-Select Grade Level-</option>
                          @foreach ($schoolyear as $row)
                              <option value="{{$row->schoolYear}}">{{$row->schoolYear}}</option>
                          @endforeach
                    </select>
                  </div>
              </div>
              <div class="col-lg-2">
                <div class="form-group">
                  <select name="gradingperiod" id="gradingperiod" class="form-control" required>
                    <option value="" selected disabled>-Select Grading Period-</option>
                    <option value="1">1st</option>
                    <option value="2">2nd</option>
                    <option value="3">3rd</option>
                    <option value="4">4th</option>
                    <option value="final">Final</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-2">
                <div class="form-group">
                  <select name="gradeLevel" id="gradeLevel" class="form-control dynamic" data-dependent="subjectCode" required>
                      <option value="" selected disabled>-Select Grade Level-</option>
                        @foreach ($advisory as $row)
                            <option value="{{$row->gradeLevel}}">Grade {{$row->gradeLevel}}</option>
                        @endforeach
                  </select>
                </div>
              </div>
              <div class="col-lg-2">
                  <div class="form-group">
                    <select name="subjectCode" id="subjectCode" class="form-control" required>
                        <option value="" selected disabled>-Select Subject-</option>
                    </select>
                  </div>
                </div>
              <div class="col-lg-4">
                <button type="submit" name="submit" class="btn btn-primary">Proceed</button>
              </div>
            </div>
          </form>
     
          <form>
            @csrf
          <div class="table-wrapper-scroll-y">
          <table class="table" id="example">
            <thead>
              <tr>
                <th>Student Number</th>
                <th>Gender</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Grade</th>
                <th>Remarks</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          </div>
          </form>
            
            </div> 
          </div>
      </div>
      </div>
    </div>
  </div>
  </div>
@endSection
@section('scripts')
<script> 

$(document).ready(function() {
  $('#example').dataTable({
    "searching": false,
    "paging": false,
    // "processing": false,
    // "serverSide": true,
    // "ajax": "{{ route('find.grades') }}",
    //     "columns":[
    //         { "data": "Student Number" },
    //         { "data": "Gender" },
    //         { "data": "First Name" },
    //         { "data": "Middle Name" },
    //         { "data": "Last Name" },
    //         { "data": "Grade"},
    //         { "data": "Remarks", orderable:true, searchable:true}
    //     ]
  });
});

$(document).on('change', '.dynamic', function() {
  if($(this).val() != '') 
  {
    select = $(this).attr('id');
    value = $(this).val();
    dependent = $(this).data('dependent');
    _token = $('input[name="_token"]').val();
    $.ajax({
        url: "{{ route('find.advisory')}}",
        method: "POST",
        data: {
          select: select,
          value: value,
          dependent: dependent,
          _token: _token
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
    url: "{{ route('find.grades')}}",
    type: "GET",
    data: {
      "_token": $('input[name=_token]').val(),
      "employee_id": $('#employee').val(),
      "gradingperiod": $('#gradingperiod').val(),
      "gradeLevel": $('#gradeLevel').val(),
      "subjectCode": $('#subjectCode').val(),
      'schoolYear': $('#schoolYear').val()
    },
    success:function(data){
      $('tbody').html(data);
    }
  })

});


</script>
@endsection