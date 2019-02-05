@extends('layouts.admin')


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
            <div class="row">
              <div class="col-lg-2">
                <div class="form-group">
                  <select name="gradingperiod" id="gradingperiod" class="form-control">
                    <option value="" selected disabled>-Select Grading Period-</option>
                    <option value="1">1st</option>
                    <option value="2">2nd</option>
                    <option value="3">3rd</option>
                    <option value="4">4th</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-2">
                <div class="form-group">
                  <select name="gradeLevel" id="gradeLevel" class="form-control dynamic" data-dependent="subjectCode">
                      <option value="" selected disabled>-Select Grade Level-</option>
                        @foreach ($advisory as $row)
                            <option value="{{$row->gradeLevel}}">Grade {{$row->gradeLevel}}</option>
                        @endforeach
                  </select>
                </div>
              </div>
              <div class="col-lg-2">
                  <div class="form-group">
                    <select name="subjectCode" id="subjectCode" class="form-control">
                        <option value="" selected disabled>-Select Subject-</option>
                    </select>
                  </div>
                </div>
              <div class="col-lg-4">
                <button type="submit" name="submit" class="btn btn-success">Proceed</button>
              </div>
            </div>
          </form>

          <form>
            @csrf
          <div class="table-wrapper-scroll-y">
          <table class="table">
            <thead>
              <tr>
                <th>Student Number</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Grade</th>
                <th>Remarks</th>
                <th>Send Grade</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
          </div>

          <div class="form-group">
              <button class="btn btn-dark" type="submit">Send Grade</button>
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
  $('table').hide();
  $('.btn-dark').hide();
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


$('form').on('submit', function(e) {
  e.preventDefault();
  $.ajax({
    url: "{{ route('find.grades')}}",
    type: "GET",
    data: {
      "_token": $('input[name=_token]').val(),
      "gradingperiod": $('#gradingperiod').val(),
      "gradeLevel": $('#gradeLevel').val(),
      "subjectCode": $('#subjectCode').val()
    },
    success:function(data){
      $('table').show();
      $('.btn-dark').show();
      $('tbody').html(data);
    }
  })

});

$(document).on('submit', '.btn-dark', function() {
  $.ajax({
      url: "{{ route('send.grade')}}",
      type: "POST",
      data: {
        "id": $('#student_id').val(),
        "contactNumber": $('#contactNumber').val(),
        "_token": $('input[name=_token]').val()
      },
      success:function(data)
      {

      }
  }); 
});
</script>
@endsection